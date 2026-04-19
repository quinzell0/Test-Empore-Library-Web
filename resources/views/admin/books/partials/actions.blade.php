<div class="table-actions">
    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning">Edit</a>
    <button type="button" class="btn btn-danger delete-book" data-url="{{ route('admin.books.destroy', $book) }}" data-label="buku {{ $book->title }}">Hapus</button>
</div>
