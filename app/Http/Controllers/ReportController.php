<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function export()
    {
        return Excel::download(new BookingExport, 'laporan_pemesanan_'.date('Y-m-d').'.xlsx');
    }
}
