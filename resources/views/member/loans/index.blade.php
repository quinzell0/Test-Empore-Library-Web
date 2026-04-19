@extends('layouts.app', ['title' => 'List Peminjaman', 'header' => 'List Peminjaman'])

@section('page_description')
Daftar ini menampilkan seluruh buku yang sedang kamu pinjam maupun yang sudah selesai dipinjam.
@endsection

@section('content')
<div class="card reveal-up reveal-delay-1">
    <div class="card-header">
        <div class="surface-kicker">My Loans</div>
        <h3 class="card-title mb-0">Riwayat dan Status Peminjaman</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                        <tr>
                            <td>{{ $loan->book->code }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->loan_date->format('Y-m-d') }}</td>
                            <td>{{ $loan->due_date->format('Y-m-d') }}</td>
                            <td>{{ $loan->returned_at?->format('Y-m-d') ?? '-' }}</td>
                            <td>
                                @include('admin.loan-requests.partials.status', ['loan' => $loan])
                            </td>
                            <td>{{ $loan->notes ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
