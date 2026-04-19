@extends('layouts.app', ['title' => 'Ajukan Peminjaman', 'header' => 'Ajukan Peminjaman'])

@section('page_description')
Pilih buku yang tersedia dan tentukan periode pinjam dengan form yang lebih ringan dan mudah dipahami.
@endsection

@section('content')
<div class="card reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="surface-kicker">Loan Submission</div>
        <h3 class="card-title mb-0">Form Pengajuan Peminjaman Buku</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('member.loan-requests.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Buku</label>
                    <select name="book_id" class="form-control" required>
                        <option value="">Pilih buku</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" @selected(old('book_id') == $book->id)>
                                {{ $book->code }} - {{ $book->title }} (stok: {{ $book->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Tanggal Peminjaman</label>
                    <input type="date" name="loan_date" value="{{ old('loan_date') }}" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                    <label>Tanggal Pengembalian</label>
                    <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control" required>
                </div>
                <div class="col-md-12 form-group">
                    <label>Catatan</label>
                    <textarea name="notes" rows="3" class="form-control" placeholder="Opsional">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="quick-actions mt-3">
                <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
                <a href="{{ route('member.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
