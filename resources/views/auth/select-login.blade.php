@extends('layouts.auth', ['title' => 'Pilih Login'])

@section('content')
<div class="card auth-card border-0 shadow-none">
    <div class="card-header border-0 pb-0">
        <div class="auth-subtitle text-uppercase font-weight-bold" style="letter-spacing:.18em; font-size:.74rem;">Access Portal</div>
        <h1 class="mb-2">Pilih peran masuk.</h1>
        <p class="auth-subtitle mb-0">Gunakan area yang sesuai agar alur kerja dan menu yang tampil tetap relevan.</p>
    </div>
    <div class="card-body pt-4">
        <a href="{{ route('admin.login') }}" class="btn btn-auth-option btn-block">
            <span>
                <i class="fas fa-user-shield"></i>
                <span>
                    <strong class="d-block mb-1">Login Admin</strong>
                    <small class="text-muted">Kelola buku, anggota, dan daftar pengajuan.</small>
                </span>
            </span>
            <i class="fas fa-arrow-right text-muted"></i>
        </a>
        <a href="{{ route('member.login') }}" class="btn btn-auth-option btn-block mb-0">
            <span>
                <i class="fas fa-user"></i>
                <span>
                    <strong class="d-block mb-1">Login Anggota</strong>
                    <small class="text-muted">Ajukan peminjaman buku dengan cepat.</small>
                </span>
            </span>
            <i class="fas fa-arrow-right text-muted"></i>
        </a>
    </div>
</div>
@endsection
