@extends('layouts.app', ['title' => $pageTitle, 'header' => $pageTitle])

@section('page_description')
Data anggota disusun sederhana agar admin dapat menambah dan memperbarui informasi tanpa langkah yang tidak perlu.
@endsection

@section('content')
<div class="card reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="surface-kicker">Member Directory</div>
        <h3 class="card-title mb-0">{{ $pageTitle }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ $formAction }}" method="POST">
            @csrf
            @if($formMethod !== 'POST')
                @method($formMethod)
            @endif
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Kode Anggota</label>
                    <input type="text" name="member_code" value="{{ old('member_code', $member->member_code) }}" class="form-control" required>
                </div>
                <div class="col-md-8 form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $member->name) }}" class="form-control" placeholder="Masukkan nama anggota" required>
                </div>
                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $member->email) }}" class="form-control" placeholder="nama@email.com" required>
                </div>
                <div class="col-md-6 form-group">
                    <label>Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="form-control" placeholder="081234567890">
                </div>
                <div class="col-md-12 form-group">
                    <label>Alamat</label>
                    <textarea name="address" rows="3" class="form-control" placeholder="Alamat anggota">{{ old('address', $member->address) }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label>Password {{ $formMethod === 'POST' ? '' : '(kosongkan jika tidak diubah)' }}</label>
                    <input type="password" name="password" class="form-control" {{ $formMethod === 'POST' ? 'required' : '' }}>
                </div>
            </div>
            <div class="quick-actions mt-3">
                <button type="submit" class="btn btn-primary">Simpan Anggota</button>
                <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
