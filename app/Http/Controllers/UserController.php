<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // API Register
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'division_id' => 'required|integer',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'staff';
        $user = User::create($data);
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Register admin
    public function registerAdmin(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'division_id' => 'required|integer',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'admin';
        $user = User::create($data);
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Register auditor
    public function registerAuditor(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'division_id' => 'required|integer',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'auditor';
        $user = User::create($data);
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // API Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // API Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'username' => 'required|string',
            'password' => 'required|string',
            'division_id' => 'required|integer',
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'nama' => 'sometimes|string',
            'email' => 'sometimes|email',
            'username' => 'sometimes|string',
            'password' => 'sometimes|string',
            'division_id' => 'sometimes|integer',
        ]);
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
