@extends('layouts.app', ['title' => 'Data Anggota', 'header' => 'Data Anggota'])

@section('page_description')
Kelola data anggota dalam struktur yang lebih jelas agar informasi utama mudah dibaca dan cepat diperbarui.
@endsection

@section('content')
<div class="card card-lift data-surface reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="card-header-actions">
            <div class="card-header-copy">
                <h3 class="card-title mb-0">Daftar Anggota</h3>
                <p class="card-description">Tabel ini menampilkan data inti anggota secara ringkas agar admin bisa fokus pada identitas, kontak, dan tindakan lanjutan.</p>
            </div>
            <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-sm">Tambah Anggota</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-shell">
            <table id="members-table" class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
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
        initResponsiveDataTable('#members-table', {
            ajax: '{{ route('admin.members.data') }}',
            columns: [
                { data: 'member_code', name: 'member_code' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            responsiveColumns: {
                tablet: [3],
                mobile: [0, 2, 3],
                mobileKeep: [0]
            }
        });

        bindAjaxDelete('.delete-member', '#members-table');
    });
</script>
@endpush
