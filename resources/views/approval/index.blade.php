@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/approval.css') }}" />

<div class="dashboard-container">
    <div class="card-table">
        <div class="header-section">
            <h2>Persetujuan Menunggu</h2>
            <p>Daftar permintaan kendaraan yang membutuhkan tindakan Anda.</p>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID Booking</th>
                        <th>Level Approval</th>
                        <th>Detail Kendaraan</th>
                        <th>Driver & Jadwal</th>
                        <th width="300px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approval as $item)
                        <tr>
                            <td>
                                <span class="booking-id">#{{ $item->booking->id }}</span>
                            </td>
                            <td>
                                <div class="level-badge">
                                    Current: Level {{ $item->level }}
                                </div>
                                <div class="prev-status">
                                    Prev: 
                                    @php
                                        $prevLevel = $item->booking->approvals->where('level', $item->level - 1)->first();
                                        echo $prevLevel ? ucfirst($prevLevel->status) : 'N/A (Awal)';
                                    @endphp
                                </div>
                            </td>
                            <td>
                                <div class="vehicle-info">
                                    <span class="vehicle-name">{{ $item->booking->kendaraan->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="driver-info">
                                    <strong>{{ $item->booking->driver->name }}</strong>
                                    <span>{{ $item->booking->start->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('approval.update', $item->id) }}" method="POST" class="action-form">
                                    @csrf
                                    @method('PUT')
                                    
                                    <textarea name="note" class="modern-input" placeholder="Tulis catatan (opsional)..." rows="1"></textarea>
                                    
                                    <div class="btn-group">
                                        <button type="submit" name="action" value="approved" class="btn btn-approve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            Setuju
                                        </button>
                                        <button type="submit" name="action" value="rejected" class="btn btn-reject">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            Tolak
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <img src="https://via.placeholder.com/60/e1e1e1/888888?text=Zzz" alt="Empty">
                                <p>Tidak ada permintaan yang menunggu saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection