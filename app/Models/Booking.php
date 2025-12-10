<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'admin_id',
        'kendaraan_id',
        'driver_id',
        'start',
        'end',
        'status',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    public function penggunaanKendaraan()
    {
        return $this->hasOne(PenggunaanKendaraan::class);
    }
}
