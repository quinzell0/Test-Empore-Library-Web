@if($loan->status === 'approved')
    <form action="{{ route('admin.loans.return', $loan) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-primary btn-sm">Tandai Dikembalikan</button>
    </form>
@else
    <span class="text-muted">Selesai</span>
@endif
