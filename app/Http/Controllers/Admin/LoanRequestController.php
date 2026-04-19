<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLoan;
use App\Support\DataTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoanRequestController extends Controller
{
    public function index(): View
    {
        return view('admin.loan-requests.index');
    }

    public function data(Request $request): JsonResponse
    {
        $query = $this->baseQuery()
            ->whereIn('book_loans.status', ['pending', 'approved', 'rejected', 'returned']);

        return DataTable::eloquent(
            $request,
            $query,
            ['members.member_code', 'members.name', 'books.code', 'books.title', 'book_loans.loan_date', 'book_loans.due_date', 'book_loans.status'],
            fn (BookLoan $loan) => [
                'member_code' => $loan->member->member_code,
                'member_name' => $loan->member->name,
                'book_code' => $loan->book->code,
                'book_title' => $loan->book->title,
                'loan_date' => $loan->loan_date->format('Y-m-d'),
                'due_date' => $loan->due_date->format('Y-m-d'),
                'status' => view('admin.loan-requests.partials.status', compact('loan'))->render(),
                'actions' => view('admin.loan-requests.partials.actions', compact('loan'))->render(),
            ],
        );
    }

    public function updateStatus(Request $request, BookLoan $loan): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        if ($loan->status !== 'pending') {
            return back()->withErrors([
                'status' => 'Pengajuan ini sudah diproses sebelumnya.',
            ]);
        }

        DB::transaction(function () use ($loan, $data): void {
            $lockedLoan = BookLoan::query()
                ->lockForUpdate()
                ->findOrFail($loan->id);

            if ($lockedLoan->status !== 'pending') {
                throw ValidationException::withMessages([
                    'status' => 'Pengajuan ini sudah diproses sebelumnya.',
                ]);
            }

            if ($data['status'] === 'approved') {
                $book = Book::query()
                    ->lockForUpdate()
                    ->findOrFail($lockedLoan->book_id);

                if ($book->stock < 1) {
                    throw ValidationException::withMessages([
                        'status' => 'Stok buku saat ini tidak mencukupi untuk approval.',
                    ]);
                }

                $book->decrement('stock');
            }

            $lockedLoan->update([
                'status' => $data['status'],
                'processed_by_admin_id' => Auth::guard('admin')->id(),
                'processed_at' => now(),
            ]);
        });

        $message = $data['status'] === 'approved'
            ? 'Pengajuan berhasil di-approve dan stok buku sudah diperbarui.'
            : 'Pengajuan berhasil ditolak.';

        return back()->with('success', $message);
    }

    public function loans(): View
    {
        return view('admin.loans.index');
    }

    public function loansData(Request $request): JsonResponse
    {
        $query = $this->baseQuery()
            ->whereIn('book_loans.status', ['approved', 'returned']);

        return DataTable::eloquent(
            $request,
            $query,
            ['members.member_code', 'members.name', 'books.code', 'books.title', 'book_loans.loan_date', 'book_loans.due_date', 'book_loans.status'],
            fn (BookLoan $loan) => [
                'member_code' => $loan->member->member_code,
                'member_name' => $loan->member->name,
                'book_code' => $loan->book->code,
                'book_title' => $loan->book->title,
                'loan_date' => $loan->loan_date->format('Y-m-d'),
                'due_date' => $loan->due_date->format('Y-m-d'),
                'returned_at' => $loan->returned_at?->format('Y-m-d') ?? '-',
                'status' => view('admin.loan-requests.partials.status', compact('loan'))->render(),
                'actions' => view('admin.loans.partials.actions', compact('loan'))->render(),
            ],
        );
    }

    public function markReturned(BookLoan $loan): RedirectResponse
    {
        if ($loan->status !== 'approved') {
            return back()->withErrors([
                'status' => 'Hanya peminjaman yang sedang aktif yang bisa dikembalikan.',
            ]);
        }

        DB::transaction(function () use ($loan): void {
            $lockedLoan = BookLoan::query()
                ->lockForUpdate()
                ->findOrFail($loan->id);

            if ($lockedLoan->status !== 'approved') {
                throw ValidationException::withMessages([
                    'status' => 'Peminjaman ini tidak lagi berstatus aktif.',
                ]);
            }

            Book::query()
                ->lockForUpdate()
                ->findOrFail($lockedLoan->book_id)
                ->increment('stock');

            $lockedLoan->update([
                'status' => 'returned',
                'returned_at' => now()->toDateString(),
                'processed_by_admin_id' => Auth::guard('admin')->id(),
                'processed_at' => now(),
            ]);
        });

        return back()->with('success', 'Status peminjaman berhasil diubah menjadi dikembalikan dan stok buku sudah bertambah.');
    }

    protected function baseQuery(): Builder
    {
        return BookLoan::query()
            ->select('book_loans.*')
            ->join('members', 'members.id', '=', 'book_loans.member_id')
            ->join('books', 'books.id', '=', 'book_loans.book_id')
            ->with(['member', 'book']);
    }
}
