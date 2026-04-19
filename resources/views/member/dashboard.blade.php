@extends('layouts.app', ['title' => 'Dashboard Anggota', 'header' => 'Dashboard Anggota'])

@section('page_description')
Area anggota difokuskan pada satu tujuan utama: memilih buku yang tersedia dan mengirim pengajuan peminjaman dengan cepat.
@endsection

@section('content')
<div class="dashboard-grid mb-4">
    <article class="metric-card library">
        <i class="metric-icon fas fa-book-reader"></i>
        <div class="metric-label">Available</div>
        <div class="metric-value">{{ $availableBookCount }}</div>
        <p class="metric-copy">Jumlah buku yang masih tersedia untuk diajukan saat ini.</p>
    </article>
    <article class="metric-card books">
        <i class="metric-icon fas fa-paper-plane"></i>
        <div class="metric-label">My Requests</div>
        <div class="metric-value">{{ $submissionCount }}</div>
        <p class="metric-copy">Total pengajuan peminjaman yang pernah kamu kirim melalui sistem.</p>
    </article>
    <article class="metric-card requests">
        <i class="metric-icon fas fa-book"></i>
        <div class="metric-label">Active Loans</div>
        <div class="metric-value">{{ $activeLoanCount }}</div>
        <p class="metric-copy">Jumlah buku yang saat ini sedang kamu pinjam dan belum dikembalikan.</p>
    </article>
</div>

<div class="surface-panel editorial-panel reveal-up reveal-delay-2">
    <div>
        <div class="surface-kicker">Member Flow</div>
        <h3>Pengajuan dibuat sesingkat mungkin agar fokus tetap pada pemilihan buku.</h3>
        <p>Pilih buku yang tersedia, tentukan tanggal pinjam dan tanggal kembali, lalu kirim pengajuan. Tampilan ini dirancang agar mudah dipahami bahkan oleh pengguna non-teknis.</p>
    </div>
    <div class="editorial-meta">
        <strong>Langkah Berikutnya</strong>
        <div class="quick-actions">
            <a href="{{ route('member.loan-requests.create') }}" class="btn btn-success">Ajukan Peminjaman</a>
            <a href="{{ route('member.loans.index') }}" class="btn btn-secondary">Lihat Peminjaman</a>
        </div>
    </div>
</div>
@endsection
