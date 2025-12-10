@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />

<div class="dashboard-container">
    
    <div class="hero-card">
        <div class="hero-text">
            <h2>Halo, {{ Auth::user()->name }}! 👋</h2>
            <p>Selamat datang kembali di sistem pemesanan kendaraan.</p>
            <div class="role-badge">
                LOGIN SEBAGAI: {{ strtoupper(Auth::user()->role) }}
            </div>
        </div>
        <img src="{{ asset('assets/img/Frame 31.png') }}" alt="Decoration" class="hero-bg-img">
    </div>

    <div class="section-title">Menu Cepat</div>
    
    <div class="grid-menu">
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('booking.create') }}" class="menu-card">
                <div class="icon-box icon-add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </div>
                <div class="menu-info">
                    <h4>Buat Pesanan</h4>
                    <p>Input pemesanan kendaraan baru.</p>
                </div>
            </a>

            <a href="{{ route('booking.index') }}" class="menu-card">
                <div class="icon-box icon-manage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div class="menu-info">
                    <h4>Kelola Data</h4>
                    <p>Lihat dan edit semua riwayat.</p>
                </div>
            </a>

            <a href="{{ route('booking.export') }}" class="menu-card">
                <div class="icon-box icon-excel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="8" y1="13" x2="16" y2="13"></line><line x1="8" y1="17" x2="16" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div class="menu-info">
                    <h4>Export Excel</h4>
                    <p>Unduh laporan dalam format .xlsx</p>
                </div>
            </a>
        @endif

        @if (Auth::user()->role == 'approver')
            <a href="{{ route('approval.index') }}" class="menu-card">
                <div class="icon-box icon-check">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </div>
                <div class="menu-info">
                    <h4>Cek Permintaan</h4>
                    <p>Setujui atau tolak pemesanan masuk.</p>
                </div>
            </a>
        @endif
    </div>

    <div class="stats-container">
        <div class="section-title">Statistik Pemakaian Kendaraan</div>
        
        <div class="card-stats">
            @if (count($labels) > 0)
                @php $maxVal = $data->max(); @endphp
                
                <div class="chart-list">
                    @foreach ($labels as $index => $label)
                        @php 
                            $value = $data[$index]; 
                            // Hitung persentase untuk lebar bar (hindari pembagian nol)
                            $percent = ($maxVal > 0) ? ($value / $maxVal) * 100 : 0;
                        @endphp
                        
                        <div class="chart-item">
                            <div class="chart-info">
                                <span class="chart-label">{{ $label }}</span>
                                <span class="chart-value">{{ $value }} Kali</span>
                            </div>
                            <div class="progress-bg">
                                <div class="progress-fill" style="width: {{ $percent }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-stats">
                    <img src="https://via.placeholder.com/60/e1e1e1/888888?text=Chart" alt="Empty">
                    <p>Belum ada data pemakaian kendaraan yang selesai.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection