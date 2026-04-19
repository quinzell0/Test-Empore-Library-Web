@extends('layouts.app', ['title' => 'Master Buku', 'header' => 'Master Buku'])

@section('page_description')
Kelola katalog buku dengan tampilan tabel yang lebih rapi, mudah dipindai, dan tetap efisien untuk operasional harian.
@endsection

@section('content')
<div class="card card-lift data-surface reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="card-header-actions">
            <div class="card-header-copy">
                <h3 class="card-title mb-0">Daftar Buku</h3>
                <p class="card-description">Informasi buku ditampilkan dalam mode server-side agar pencarian, sorting, dan jumlah data tetap nyaman saat katalog bertambah.</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm">Tambah Buku</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-shell">
            <table id="books-table" class="table table-bordered table-striped table-wide mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Tahun</th>
                        <th>Penulis</th>
                        <th>Stok</th>
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
        initResponsiveDataTable('#books-table', {
            ajax: '{{ route('admin.books.data') }}',
            columns: [
                { data: 'code', name: 'code' },
                { data: 'title', name: 'title' },
                { data: 'publish_year', name: 'publish_year' },
                { data: 'author', name: 'author' },
                { data: 'stock', name: 'stock' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            responsiveColumns: {
                tablet: [3],
                mobile: [0, 2, 3],
                mobileKeep: [0]
            }
        });

        bindAjaxDelete('.delete-book', '#books-table');
    });
</script>
@endpush
