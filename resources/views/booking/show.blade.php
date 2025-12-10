@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/booking/show.css') }}" />

<div class="detail-container">
    
    <div class="detail-header">
        <div class="header-left">
            <div class="title-row">
                <h2>Booking #{{ $booking->id }}</h2>
                @php
                    $statusClass = match($booking->status) {
                        'approved' => 'badge-green',
                        'rejected' => 'badge-red',
                        'completed' => 'badge-blue',
                        default => 'badge-yellow',
                    };
                @endphp
                <span class="status-badge {{ $statusClass }}">{{ strtoupper($booking->status) }}</span>
            </div>
            <p class="meta-date">Dibuat oleh {{ $booking->admin->name }} pada {{ $booking->created_at->format('d M Y, H:i') }}</p>
        </div>
        
        <div class="header-actions">
            <button onclick="window.print()" class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                Cetak
            </button>
            <a href="{{ route('booking.index') }}" class="btn btn-primary">
                Kembali
            </a>
        </div>
    </div>

    <div class="grid-layout">
        
        <div class="card-detail">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Detail Kendaraan & Driver
            </h3>
            
            <div class="info-group">
                <label>Kendaraan</label>
                <div class="value-box">
                    <strong>{{ $booking->kendaraan->name }}</strong>
                    <span class="sub-text">Plat: {{ $booking->kendaraan->plate }} | Tipe: {{ $booking->kendaraan->type == 'angkutan_orang' ? 'Angkutan Orang' : 'Angkutan Barang' }}</span>
                </div>
            </div>

            <div class="info-group">
                <label>Driver Bertugas</label>
                <div class="value-box">
                    <strong>{{ $booking->driver->name }}</strong>
                </div>
            </div>

            <div class="info-group">
                <label>Jadwal Pemakaian</label>
                <div class="date-display">
                    <div class="date-item">
                        <span>Mulai</span>
                        <strong>{{ $booking->start->format('d M Y') }}</strong>
                        <small>{{ $booking->start->format('H:i') }} WIB</small>
                    </div>
                    <div class="date-arrow">➝</div>
                    <div class="date-item">
                        <span>Selesai</span>
                        <strong>{{ $booking->end->format('d M Y') }}</strong>
                        <small>{{ $booking->end->format('H:i') }} WIB</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-detail">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                Riwayat Persetujuan
            </h3>
            
            <div class="approval-timeline">
                @foreach($booking->approvals as $approval)
                    <div class="timeline-item">
                        <div class="timeline-marker {{ $approval->status == 'approved' ? 'marker-green' : ($approval->status == 'rejected' ? 'marker-red' : 'marker-gray') }}"></div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="level-name">Level {{ $approval->level }} - {{ $approval->approver->name }}</span>
                                <span class="status-text {{ $approval->status }}">
                                    {{ $approval->status == 'pending' ? 'Menunggu' : ucfirst($approval->status) }}
                                </span>
                            </div>
                            @if($approval->note)
                                <div class="timeline-note">"{{ $approval->note }}"</div>
                            @endif
                            <div class="timeline-time">
                                Update: {{ $approval->updated_at->format('d M H:i') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if($booking->usage)
        <div class="usage-section">
            <h3 class="section-head">Laporan Pasca Pemakaian</h3>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-fuel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.74 5.88a5.81 5.81 0 0 1 1.57 3.91V16a2 2 0 0 1-2 2h-1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3H8v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3H3a2 2 0 0 1-2-2v-3.51a5.81 5.81 0 0 1 1.57-3.91L8.31 2.69a6 6 0 0 1 8 0z"></path></svg>
                    </div>
                    <div class="stat-info">
                        <span>Konsumsi BBM</span>
                        <strong>{{ $booking->usage->gas_bbm }} Liter</strong>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-distance">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <div class="stat-info">
                        <span>Total Jarak</span>
                        <strong>{{ $booking->usage->end_km - $booking->usage->start_km }} KM</strong>
                    </div>
                </div>

                <div class="stat-card-wide">
                    <div class="km-details">
                        <div>
                            <span>KM Awal</span>
                            <strong>{{ number_format($booking->usage->start_km) }}</strong>
                        </div>
                        <div class="divider-v"></div>
                        <div>
                            <span>KM Akhir</span>
                            <strong>{{ number_format($booking->usage->end_km) }}</strong>
                        </div>
                    </div>
                    @if($booking->usage->note)
                        <div class="usage-note">
                            Catatan: {{ $booking->usage->note }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

</div>
@endsection