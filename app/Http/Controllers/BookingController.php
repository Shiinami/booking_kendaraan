<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Approval;
use App\Models\Kendaraan;
use App\Models\Driver;
use App\Models\User;
use App\Models\Logs;
use Illuminate\Support\Facades\DB;
use App\Models\PenggunaanKendaraan;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $booking = Booking::with(['kendaraan', 'driver', 'approvals'])->latest()->get();
        return view('booking.index', compact('booking'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::where('status', 'available')->get(); 
        $drivers  = Driver::all();
        $approvers = User::where('role', 'approver')->get();

        return view('booking.create', compact('kendaraans', 'drivers', 'approvers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'driver_id'  => 'required|exists:drivers,id',
            'start' => 'required|date',
            'end'   => 'required|date|after:start',
            'approvers'  => 'required|array|min:2',
            'approvers.*' => 'exists:users,id',
        ]);

        DB::transaction(function () use ($request) {
            $booking = Booking::create([
                'admin_id'   => Auth::id(),
                'kendaraan_id' => $request->kendaraan_id,
                'driver_id'  => $request->driver_id,
                'start' => $request->start,
                'end'   => $request->end,
                'status'     => 'pending',
            ]);

            foreach ($request->approvers as $index => $approverId) {
                Approval::create([
                    'booking_id'  => $booking->id,
                    'approver_id' => $approverId,
                    'level'       => $index + 1,
                    'status'      => 'pending',
                ]);
            }

            Logs::create([
                'user_id' => Auth::id(),
                'action'  => 'CREATE_BOOKING',
                'description' => "Membuat booking baru ID: {$booking->id}",
            ]);
        });

        return redirect()->route('booking.index')->with('success', 'Pemesanan berhasil dibuat, menunggu persetujuan.');
    }

    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking dihapus');
    }

    public function storeUsage(Request $request, Booking $booking)
    {
        $request->validate([
            'gas_bbm' => 'required|numeric',
            'start_km' => 'required|numeric',
            'end_km' => 'required|numeric|gt:start_km',
        ]);

        PenggunaanKendaraan::create([
            'booking_id' => $booking->id,
            'gas_bbm' => $request->gas_bbm,
            'start_km' => $request->start_km,
            'end_km' => $request->end_km,
            'note' => $request->note
        ]);

        $booking->update(['status' => 'completed']);

        return back()->with('success', 'Laporan pemakaian disimpan.');
    }
}
