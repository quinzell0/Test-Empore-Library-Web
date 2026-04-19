<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $member = Auth::guard('member')->user();

        return view('member.dashboard', [
            'availableBookCount' => Book::where('stock', '>', 0)->count(),
            'submissionCount' => BookLoan::where('member_id', $member->id)->count(),
        ]);
    }
}
