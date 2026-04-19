@extends('layouts.auth', ['title' => 'Login Admin'])

@section('content')
<div class="card auth-card border-0 shadow-none">
    <div class="card-header border-0 pb-0">
        <div class="auth-subtitle text-uppercase font-weight-bold" style="letter-spacing:.18em; font-size:.74rem;">Admin Access</div>
        <h1 class="mb-2">Masuk sebagai admin.</h1>
        <p class="auth-subtitle mb-0">Akses dashboard pengelolaan buku, anggota, dan pemantauan pengajuan.</p>
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
            <div><b>Email:</b> admin@library.test</div>
            <div><b>Password:</b> password</div>
        </div>
        <form action="{{ route('admin.login.store') }}" method="POST" novalidate data-auth-guard>
            @csrf
            <div class="form-group">
                <label for="admin-email">Email</label>
                <div class="input-shell">
                    <input
                        id="admin-email"
                        type="email"
                        name="email"
                        value="{{ old('email', 'admin@library.test') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        autocomplete="username"
                        inputmode="email"
                        aria-describedby="admin-email-feedback"
                        required
                    >
                </div>
                <div class="field-hint">Gunakan email admin yang terdaftar untuk mengakses dashboard.</div>
                <div id="admin-email-feedback" class="invalid-feedback" @error('email') @else hidden data-dynamic="true" @enderror>{{ $errors->first('email') }}</div>
            </div>
            <div class="form-group">
                <label for="admin-password">Password</label>
                <div class="input-shell">
                    <input
                        id="admin-password"
                        type="password"
                        name="password"
                        value="password"
                        class="form-control has-action @error('password') is-invalid @enderror"
                        autocomplete="current-password"
                        aria-describedby="admin-password-feedback"
                        required
                    >
                    <button type="button" class="input-action" data-password-toggle="admin-password" aria-label="Tampilkan password" aria-pressed="false">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="field-hint">Pastikan tidak ada typo atau Caps Lock aktif saat mengetik password.</div>
                <div class="caps-warning" data-caps-warning>Caps Lock terdeteksi. Periksa huruf besar/kecil pada password.</div>
                <div id="admin-password-feedback" class="invalid-feedback" @error('password') @else hidden data-dynamic="true" @enderror>{{ $errors->first('password') }}</div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk ke Dashboard Admin</button>
        </form>
        <a href="{{ route('login.selector') }}" class="d-inline-block mt-3 auth-link">Kembali ke pilihan login</a>
    </div>
</div>
@endsection
