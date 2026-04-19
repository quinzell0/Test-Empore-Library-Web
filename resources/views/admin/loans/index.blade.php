@extends('layouts.app', ['title' => 'Peminjaman Buku', 'header' => 'Peminjaman Buku'])

@section('page_description')
Monitor seluruh buku yang sedang dipinjam atau sudah dikembalikan, lalu ubah status saat anggota menyerahkan buku kembali.
@endsection

@section('content')
<div class="card card-lift data-surface reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="card-header-copy">
            <h3 class="card-title mb-0">List Peminjaman Buku</h3>
            <p class="card-description">Data ini hanya menampilkan pengajuan yang sudah di-approve, termasuk histori pengembalian yang telah selesai diproses.</p>
        </div>
    </div>
    <div class="card-body">
        <div class="table-shell">
            <table id="loans-table" class="table table-bordered table-striped table-wide mb-0">
                <thead>
                    <tr>
                        <th>Kode Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Tgl Kembali Aktual</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
        initResponsiveDataTable('#loans-table', {
            ajax: '{{ route('admin.loans.data') }}',
            columns: [
                { data: 'member_code', name: 'member_code' },
                { data: 'member_name', name: 'member_name' },
                { data: 'book_code', name: 'book_code' },
                { data: 'book_title', name: 'book_title' },
                { data: 'loan_date', name: 'loan_date' },
                { data: 'due_date', name: 'due_date' },
                { data: 'returned_at', name: 'returned_at', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            responsiveColumns: {
                tablet: [0, 2, 7],
                mobile: [0, 2, 7],
                mobileKeep: []
            }
        });
    });
</script>
@endpush
