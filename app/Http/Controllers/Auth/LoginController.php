<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Features;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $role = Auth::user()->role ?? null;
            if ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
             Auth::logout();
             $request->session()->invalidate();
             $request->session()->regenerateToken();

             return back()->withErrors([
            'email' => 'Access denied. Admin only.',
            ])->withInput();
        } 
        return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (
                Features::canManageTwoFactorAuthentication()
                && !empty($user?->two_factor_secret)
                && !empty($user?->two_factor_confirmed_at)
            ) {
                Auth::logout();
                $request->session()->put([
                    'login.id' => $user->user_id,
                    'login.remember' => $request->boolean('remember'),
                ]);

                return redirect()->route('two-factor.login');
            }

            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink([
            'email' => $request->input('email'),
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}
