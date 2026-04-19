<div class="table-actions">
    <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-warning">Edit</a>
    <button type="button" class="btn btn-danger delete-member" data-url="{{ route('admin.members.destroy', $member) }}" data-label="anggota {{ $member->name }}">Hapus</button>
</div>
