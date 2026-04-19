@extends('layouts.auth', ['title' => 'Login Anggota'])

@section('content')
<div class="card auth-card border-0 shadow-none">
    <div class="card-header border-0 pb-0">
        <div class="auth-subtitle text-uppercase font-weight-bold" style="letter-spacing:.18em; font-size:.74rem;">Member Access</div>
        <h1 class="mb-2">Masuk sebagai anggota.</h1>
        <p class="auth-subtitle mb-0">Ajukan peminjaman buku melalui panel yang lebih sederhana dan fokus.</p>
    </div>
    <div class="card-body pt-4">
        @if(session('auth_feedback'))
            <div class="auth-alert auth-alert-danger" role="alert">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <strong>{{ session('auth_feedback.title') }}</strong>
                    <p>{{ session('auth_feedback.message') }}</p>
                </div>
            </div>
        @elseif($errors->any())
            <div class="auth-alert auth-alert-warning" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Form login perlu diperiksa</strong>
                    <p>{{ $errors->first() }}</p>
                </div>
            </div>
        @endif
        <div class="demo-box">
            <strong>Akun Demo</strong>
            <div><b>Email:</b> anggota@library.test</div>
            <div><b>Password:</b> password</div>
        </div>
        <form action="{{ route('member.login.store') }}" method="POST" novalidate data-auth-guard>
            @csrf
            <div class="form-group">
                <label for="member-email">Email</label>
                <div class="input-shell">
                    <input
                        id="member-email"
                        type="email"
                        name="email"
                        value="{{ old('email', 'anggota@library.test') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        autocomplete="username"
                        inputmode="email"
                        aria-describedby="member-email-feedback"
                        required
                    >
                </div>
                <div class="field-hint">Masukkan email anggota yang sudah terdaftar pada sistem perpustakaan.</div>
                <div id="member-email-feedback" class="invalid-feedback" @error('email') @else hidden data-dynamic="true" @enderror>{{ $errors->first('email') }}</div>
            </div>
            <div class="form-group">
                <label for="member-password">Password</label>
                <div class="input-shell">
                    <input
                        id="member-password"
                        type="password"
                        name="password"
                        value="password"
                        class="form-control has-action @error('password') is-invalid @enderror"
                        autocomplete="current-password"
                        aria-describedby="member-password-feedback"
                        required
                    >
                    <button type="button" class="input-action" data-password-toggle="member-password" aria-label="Tampilkan password" aria-pressed="false">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="field-hint">Jika login gagal, cek kembali password dan pastikan akun yang dipakai memang area anggota.</div>
                <div class="caps-warning" data-caps-warning>Caps Lock terdeteksi. Periksa huruf besar/kecil pada password.</div>
                <div id="member-password-feedback" class="invalid-feedback" @error('password') @else hidden data-dynamic="true" @enderror>{{ $errors->first('password') }}</div>
            </div>
            <button type="submit" class="btn btn-success btn-block">Masuk ke Panel Anggota</button>
        </form>
        <a href="{{ route('login.selector') }}" class="d-inline-block mt-3 auth-link">Kembali ke pilihan login</a>
    </div>
</div>
@endsection
