<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Booking;
use App\Models\Logs;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $approval = Approval::with(['booking.kendaraan', 'booking.driver'])
            ->where('approver_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return view('approval.index', compact('approval'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approved,rejected',
            'note'   => 'nullable|string'
        ]);

        $nowApproval = Approval::findOrFail($id);

        if ($nowApproval->approver_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($nowApproval->level > 1) {
            $previousLevel = Approval::where('booking_id', $nowApproval->booking_id)
                ->where('level', $nowApproval->level - 1)
                ->first();

            if ($previousLevel && $previousLevel->status !== 'approved') {
                return back()->with('error', 'Tidak bisa menyetujui. Level sebelumnya belum menyetujui.');
            }
        }

        $nowApproval->update([
            'status' => $request->action,
            'note'   => $request->note
        ]);

        $booking = Booking::find($nowApproval->booking_id);

        if ($request->action == 'rejected') {
            $booking->update(['status' => 'rejected']);
        } else {
            $sisaApproval = Approval::where('booking_id', $booking->id)
                ->where('status', '!=', 'approved')
                ->count();

            if ($sisaApproval == 0) {
                $booking->update(['status' => 'approved']);
            }
        }

        // 5. Log
        Logs::create([
            'user_id' => Auth::id(),
            'action'  => strtoupper($request->action) . "_LEVEL_" . $nowApproval->level,
            'description' => "User melakukan {$request->action} pada booking #{$booking->id}",
            'subject_id' => $booking->id
        ]);

        return redirect()->route('approval.index')->with('success', 'Status berhasil diperbarui.');
    }
}
