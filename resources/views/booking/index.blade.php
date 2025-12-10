@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/booking/index.css') }}" />

<div class="table-container">
    <div class="card-table">
        
        <div class="table-header">
            <div class="header-text">
                <h2>Daftar Pemesanan</h2>
                <p>Kelola semua data pemakaian kendaraan di sini.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('booking.export') }}" class="btn btn-outline-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="8" y1="13" x2="16" y2="13"></line><line x1="8" y1="17" x2="16" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    Export Excel
                </a>
                <a href="{{ route('booking.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Pesanan Baru
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Info Kendaraan</th>
                        <th width="20%">Jadwal</th>
                        <th width="25%">Status Approval</th>
                        <th width="10%">Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($booking as $item)
                        <tr>
                            <td><span class="id-badge">#{{ $item->id }}</span></td>
                            <td>
                                <div class="info-cell">
                                    <span class="info-title">{{ $item->kendaraan->name }}</span>
                                    <span class="info-sub">Driver: {{ $item->driver->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="date-cell">
                                    <span>{{ $item->start->format('d M Y') }}</span>
                                    <span class="arrow">➝</span>
                                    <span>{{ $item->end->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td>
                                <ul class="approval-list">
                                    @foreach($item->approvals as $approval)
                                        <li>
                                            <span class="approver-name">Lv {{ $approval->level }} ({{ $approval->approver->name }})</span>
                                            @php
                                                $badgeClass = match($approval->status) {
                                                    'approved' => 'badge-green',
                                                    'rejected' => 'badge-red',
                                                    default => 'badge-yellow',
                                                };
                                            @endphp
                                            <span class="badge-mini {{ $badgeClass }}">{{ ucfirst($approval->status) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @php
                                    $mainStatusClass = match($item->status) {
                                        'approved' => 'badge-outline-green',
                                        'completed' => 'badge-outline-blue',
                                        'rejected' => 'badge-outline-red',
                                        default => 'badge-outline-yellow',
                                    };
                                @endphp
                                <span class="badge-status {{ $mainStatusClass }}">{{ strtoupper($item->status) }}</span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <form action="{{ route('booking.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data #{{ $item->id }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon-delete" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>

                                    @if($item->status == 'approved')
                                        <details class="dropdown-complete">
                                            <summary class="btn-complete-toggle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                Selesaikan
                                            </summary>
                                            
                                            <div class="complete-form-box">
                                                <h4>Input Data Akhir</h4>
                                                <form action="{{ route('booking.complete', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-row">
                                                        <label>BBM (Liter)</label>
                                                        <input type="number" step="0.1" name="gas_bbm" required>
                                                    </div>
                                                    <div class="form-row">
                                                        <label>KM Awal</label>
                                                        <input type="number" name="start_km" required>
                                                    </div>
                                                    <div class="form-row">
                                                        <label>KM Akhir</label>
                                                        <input type="number" name="end_km" required>
                                                    </div>
                                                    <button type="submit" class="btn-save-complete">Simpan</button>
                                                </form>
                                            </div>
                                        </details>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <img src="https://via.placeholder.com/60/e1e1e1/888888?text=Empty" alt="Empty">
                                <p>Belum ada data pemesanan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection