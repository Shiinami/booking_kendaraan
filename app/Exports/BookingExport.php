<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Booking;

class BookingExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        return Booking::with(['kendaraan', 'driver', 'approvals.approver'])
            ->get()
            ->map(function ($booking) {
                return [
                    'ID' => $booking->id,
                    'Kendaraan' => $booking->kendaraan->name,
                    'Driver' => $booking->driver->name,
                    'Tanggal Mulai' => $booking->start,
                    'Status' => $booking->status,
                    'Approver' => $booking->approvals->pluck('approver.name')->join(', '),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kendaraan',
            'Driver',
            'Tanggal Mulai',
            'Status',
            'Approver',
        ];
    }
}
