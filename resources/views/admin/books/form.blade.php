@extends('layouts.app', ['title' => $pageTitle, 'header' => $pageTitle])

@section('page_description')
Lengkapi informasi buku secara ringkas agar katalog tetap konsisten, mudah dicari, dan siap digunakan pada proses peminjaman.
@endsection

@section('content')
<div class="card reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="surface-kicker">Book Catalog</div>
        <h3 class="card-title mb-0">{{ $pageTitle }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ $formAction }}" method="POST">
            @csrf
            @if($formMethod !== 'POST')
                @method($formMethod)
            @endif
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Kode Buku</label>
                    <input type="text" name="code" value="{{ old('code', $book->code) }}" class="form-control" placeholder="Contoh: BK003" required>
                </div>
                <div class="col-md-6 form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-control" placeholder="Masukkan judul buku" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="publish_year" value="{{ old('publish_year', $book->publish_year) }}" class="form-control" placeholder="2025" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Penulis</label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" class="form-control" placeholder="Nama penulis" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Stok</label>
                    <input type="number" min="0" name="stock" value="{{ old('stock', $book->stock ?? 0) }}" class="form-control" required>
                </div>
            </div>
            <div class="quick-actions mt-3">
                <button type="submit" class="btn btn-primary">Simpan Buku</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
