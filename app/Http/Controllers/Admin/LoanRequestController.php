<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookLoan;
use App\Support\DataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanRequestController extends Controller
{
    public function index(): View
    {
        return view('admin.loan-requests.index');
    }

    public function data(Request $request): JsonResponse
    {
        $query = BookLoan::query()
            ->select('book_loans.*')
            ->join('members', 'members.id', '=', 'book_loans.member_id')
            ->join('books', 'books.id', '=', 'book_loans.book_id')
            ->with(['member', 'book']);

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
            ],
        );
    }
}
