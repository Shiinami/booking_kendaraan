<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenggunaanKendaraan extends Model
{
    protected $fillable = [
        'booking_id',
        'gas_bbm',
        'start_km',
        'end_km',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
