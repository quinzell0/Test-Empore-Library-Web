<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Daftar buku berhasil diambil.',
            'data' => Book::query()->orderBy('code')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $book = Book::create($this->validatedData($request));

        return response()->json([
            'message' => 'Buku berhasil dibuat.',
            'data' => $book,
        ], 201);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json([
            'message' => 'Detail buku berhasil diambil.',
            'data' => $book,
        ]);
    }

    public function update(Request $request, Book $book): JsonResponse
    {
        $book->update($this->validatedData($request, $book));

        return response()->json([
            'message' => 'Buku berhasil diperbarui.',
            'data' => $book->fresh(),
        ]);
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
