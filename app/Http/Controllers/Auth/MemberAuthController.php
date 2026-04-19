<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberAuthController extends Controller
{
    public function create(): View
    {
        return view('auth.member-login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('member')->attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password anggota tidak valid.',
            ])->with('auth_feedback', [
                'type' => 'danger',
                'title' => 'Login anggota gagal',
                'message' => 'Email atau password anggota tidak cocok. Coba lagi dengan data yang benar.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('member.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.login');
    }
}
