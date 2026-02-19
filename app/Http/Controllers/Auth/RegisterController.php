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
            'nama' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'division_id' => 'nullable|integer|exists:divisions,division_id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $divisionId = $request->division_id;
        if (!$divisionId) {
            $divisionId = Division::query()->value('division_id');

            if (!$divisionId) {
                $divisionId = Division::create([
                    'Nama_Divisi' => 'General',
                    'Deskripsi' => 'Default division',
                ])->division_id;
            }
        }

        $displayName = $request->nama ?: $request->name;
        $username = $request->username ?: explode('@', $request->email)[0];

        $user = User::create([
            'Nama' => $displayName,
            'username' => $username,
            'email' => $request->email,
            'division_id' => $divisionId,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'division_id' => 'required|integer|exists:divisions,division_id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'Nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return response()->json(['message' => 'Admin registered successfully.'], 201);
    }
}
