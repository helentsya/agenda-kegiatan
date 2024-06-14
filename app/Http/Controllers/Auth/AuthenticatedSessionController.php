<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->roles == 'admin') {
            
            return redirect(RouteServiceProvider::ADMIN);

        } else if (Auth::user()->roles == 'pegawai'){

            return redirect(RouteServiceProvider::PEGAWAI);

        } else if (Auth::user()->roles == 'kepalapejabat') {

            return redirect(RouteServiceProvider::KEPALA);

        } else if (Auth::user()->roles == 'bidang') {

            return redirect(RouteServiceProvider::BIDANG);

        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
