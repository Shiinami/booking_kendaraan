<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $chartData = Booking::selectRaw('kendaraan_id, count(*) as total')
            ->where('status', 'completed')
            ->groupBy('kendaraan_id')
            ->with('kendaraan')
            ->get();

        $labels = $chartData->pluck('kendaraan.name');
        $data   = $chartData->pluck('total');

        return view('dashboard', compact('labels', 'data'));
    }
}
