@extends('layouts.app', ['title' => 'Pengajuan Buku', 'header' => 'Pengajuan Buku'])

@section('page_description')
Pantau seluruh pengajuan peminjaman anggota dalam satu tabel yang ringkas dan mudah di-review.
@endsection

@section('content')
<div class="card card-lift data-surface reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="card-header-copy">
            <h3 class="card-title mb-0">List Pengajuan Peminjaman Buku</h3>
            <p class="card-description">Setiap baris menampilkan peminjam, buku yang dipilih, periode pinjam, dan status pengajuan secara langsung.</p>
        </div>
    </div>
    <div class="card-body">
        <div class="table-shell">
            <table id="loan-requests-table" class="table table-bordered table-striped table-wide mb-0">
                <thead>
                    <tr>
                        <th>Kode Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        initResponsiveDataTable('#loan-requests-table', {
            ajax: '{{ route('admin.loan-requests.data') }}',
            columns: [
                { data: 'member_code', name: 'member_code' },
                { data: 'member_name', name: 'member_name' },
                { data: 'book_code', name: 'book_code' },
                { data: 'book_title', name: 'book_title' },
                { data: 'loan_date', name: 'loan_date' },
                { data: 'due_date', name: 'due_date' },
                { data: 'status', name: 'status', orderable: false, searchable: false }
            ],
            responsiveColumns: {
                tablet: [0, 2],
                mobile: [0, 2, 5],
                mobileKeep: []
            }
        });
    });
</script>
@endpush
