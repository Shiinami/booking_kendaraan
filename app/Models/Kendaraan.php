<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'name',
        'type',
        'plate',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
