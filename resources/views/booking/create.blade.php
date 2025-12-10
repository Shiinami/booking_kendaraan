@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/booking/create.css') }}" />

<div class="form-container">
    <div class="card-form">
        
        <div class="form-header">
            <div class="header-title">
                <h2>Buat Pesanan Baru</h2>
                <p>Isi formulir di bawah untuk mengajukan pemakaian kendaraan.</p>
            </div>
            <a href="{{ route('booking.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali
            </a>
        </div>

        <hr class="divider">

        <form action="{{ route('booking.store') }}" method="POST">
            @csrf

            <div class="form-section">
                <h3 class="section-label">1. Informasi Aset</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Pilih Kendaraan</label>
                        <div class="select-wrapper">
                            <select name="kendaraan_id" required>
                                <option value="" disabled selected>-- Cari Kendaraan --</option>
                                @foreach ($kendaraans as $kendaraan)
                                    <option value="{{ $kendaraan->id }}">{{ $kendaraan->name }} ({{ $kendaraan->plate }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Pilih Driver</label>
                        <div class="select-wrapper">
                            <select name="driver_id" required>
                                <option value="" disabled selected>-- Tentukan Driver --</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-label">2. Jadwal Pemakaian</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="datetime-local" name="start" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="datetime-local" name="end" class="form-input" required>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-label">3. Otorisasi (Approval)</h3>
                <p class="section-desc">Minimal 2 level persetujuan diperlukan sesuai SOP.</p>

                <div class="approval-box">
                    <div class="form-group">
                        <label class="badge-level">Level 1 (Manager)</label>
                        <div class="select-wrapper">
                            <select name="approvers[]" required>
                                <option value="" disabled selected>-- Pilih Atasan Langsung --</option>
                                @foreach ($approvers as $approver)
                                    <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="badge-level">Level 2 (Kepala Cabang)</label>
                        <div class="select-wrapper">
                            <select name="approvers[]" required>
                                <option value="" disabled selected>-- Pilih Kepala Cabang --</option>
                                @foreach ($approvers as $approver)
                                    <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    Simpan Pesanan
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                </button>
            </div>

        </form>
    </div>
</div>
@endsection