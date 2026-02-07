<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $divisions = Division::orderBy('Nama_Divisi')->get();
        return view('auth.register', compact('divisions'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'division_id' => 'required|integer|exists:divisions,division_id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'Nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        Auth::login($user);
        return redirect()->route('staff.dashboard');
    }
}
