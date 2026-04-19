@extends('layouts.app', ['title' => 'Dashboard Admin', 'header' => 'Dashboard Admin'])

@section('page_description')
Ringkasan operasional untuk memantau katalog, anggota, dan pengajuan peminjaman dalam satu tampilan yang cepat dibaca.
@endsection

@section('content')
<div class="dashboard-grid mb-4">
    <article class="metric-card books">
        <i class="metric-icon fas fa-book"></i>
        <div class="metric-label">Katalog</div>
        <div class="metric-value">{{ $bookCount }}</div>
        <p class="metric-copy">Total judul buku yang saat ini tercatat dalam sistem perpustakaan.</p>
    </article>
    <article class="metric-card members">
        <i class="metric-icon fas fa-users"></i>
        <div class="metric-label">Anggota</div>
        <div class="metric-value">{{ $memberCount }}</div>
        <p class="metric-copy">Jumlah anggota yang telah terdaftar dan siap melakukan pengajuan peminjaman.</p>
    </article>
    <article class="metric-card requests">
        <i class="metric-icon fas fa-clipboard-list"></i>
        <div class="metric-label">Pending</div>
        <div class="metric-value">{{ $pendingRequestCount }}</div>
        <p class="metric-copy">Pengajuan buku yang masih menunggu proses lanjutan.</p>
    </article>
</div>

<div class="surface-panel editorial-panel reveal-up reveal-delay-2">
    <div>
        <div class="surface-kicker">Admin Workspace</div>
        <h3>Panel kerja untuk mengelola perpustakaan dengan ritme yang lebih tenang.</h3>
        <p>Struktur visual dibuat agar recruiter atau user bisa langsung memahami tiga area inti aplikasi: pengelolaan buku, pengelolaan anggota, dan daftar pengajuan peminjaman. Tidak ada elemen yang tidak punya fungsi operasional.</p>
    </div>
    <div class="editorial-meta">
        <strong>Aksi Cepat</strong>
        <div class="quick-actions">
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Tambah Buku</a>
            <a href="{{ route('admin.members.create') }}" class="btn btn-secondary">Tambah Anggota</a>
            <a href="{{ route('admin.loan-requests.index') }}" class="btn btn-success">Lihat Pengajuan</a>
        </div>
    </div>
</div>
@endsection
