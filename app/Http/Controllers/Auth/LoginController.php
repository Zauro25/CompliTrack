<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $role = Auth::user()->role ?? null;
            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'staff' => redirect()->route('staff.dashboard'),
                'auditor' => redirect()->route('auditor.dashboard'),
                default => redirect()->route('home'),
            };
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
}
