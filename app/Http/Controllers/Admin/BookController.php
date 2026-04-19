<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Support\DataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        return view('admin.books.index');
    }

    public function data(Request $request): JsonResponse
    {
        return DataTable::eloquent(
            $request,
            Book::query(),
            ['code', 'title', 'publish_year', 'author', 'stock'],
            fn (Book $book) => [
                'code' => $book->code,
                'title' => $book->title,
                'publish_year' => $book->publish_year,
                'author' => $book->author,
                'stock' => $book->stock,
                'actions' => view('admin.books.partials.actions', compact('book'))->render(),
            ],
        );
    }

    public function create(): View
    {
        return view('admin.books.form', [
            'book' => new Book,
            'pageTitle' => 'Tambah Buku',
            'formAction' => route('admin.books.store'),
            'formMethod' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Book::create($this->validatedData($request));

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book): View
    {
        return view('admin.books.form', [
            'book' => $book,
            'pageTitle' => 'Edit Buku',
            'formAction' => route('admin.books.update', $book),
            'formMethod' => 'PUT',
        ]);
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $book->update($this->validatedData($request, $book));

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book): JsonResponse
    {
        if ($book->loans()->exists()) {
            return response()->json([
                'message' => 'Buku tidak bisa dihapus karena sudah memiliki histori pengajuan.',
            ], 422);
        }

        $book->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus.',
        ]);
    }

    private function validatedData(Request $request, ?Book $book = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('books', 'code')->ignore($book?->id)],
            'title' => ['required', 'string', 'max:255'],
            'publish_year' => ['required', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'author' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);
    }
}
