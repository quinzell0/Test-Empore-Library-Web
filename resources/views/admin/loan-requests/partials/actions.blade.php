@if($loan->status === 'pending')
    <div class="d-flex flex-wrap" style="gap: .5rem;">
        <form action="{{ route('admin.loan-requests.update-status', $loan) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="approved">
            <button type="submit" class="btn btn-success btn-sm">Approve</button>
        </form>
        <form action="{{ route('admin.loan-requests.update-status', $loan) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="rejected">
            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
        </form>
    </div>
@else
    <span class="text-muted">Sudah diproses</span>
@endif
