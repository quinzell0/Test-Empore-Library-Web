<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoanRequestController extends Controller
{
    public function create(): View
    {
        return view('member.loan-requests.create', [
            'books' => Book::query()->where('stock', '>', 0)->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'loan_date' => ['required', 'date', 'after_or_equal:today'],
            'due_date' => ['required', 'date', 'after:loan_date'],
            'notes' => ['nullable', 'string'],
        ]);

        $book = Book::findOrFail($data['book_id']);

        if ($book->stock < 1) {
            return back()->withErrors([
                'book_id' => 'Stok buku saat ini kosong.',
            ])->withInput();
        }

        BookLoan::create([
            'member_id' => Auth::guard('member')->id(),
            'book_id' => $book->id,
            'loan_date' => $data['loan_date'],
            'due_date' => $data['due_date'],
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }
}
