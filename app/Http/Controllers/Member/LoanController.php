<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\BookLoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoanController extends Controller
{
    public function index(): View
    {
        $member = Auth::guard('member')->user();

        return view('member.loans.index', [
            'loans' => BookLoan::query()
                ->with('book')
                ->where('member_id', $member->id)
                ->whereIn('status', ['approved', 'returned'])
                ->latest('loan_date')
                ->latest('created_at')
                ->get(),
        ]);
    }
}
