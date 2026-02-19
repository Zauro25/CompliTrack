<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(User::with('division')->get());
        }

        $users = User::with('division')->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $divisions = Division::orderBy('Nama_Divisi')->get();

        return view('admin.users.create', compact('divisions'));
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
        $user = User::create([
            'Nama' => $data['nama'],
            'email' => $data['email'],
            'username' => $data['username'],
            'division_id' => $data['division_id'],
            'password' => bcrypt($data['password']),
            'role' => 'staff',
        ]);
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
        $user = User::create([
            'Nama' => $data['nama'],
            'email' => $data['email'],
            'username' => $data['username'],
            'division_id' => $data['division_id'],
            'password' => bcrypt($data['password']),
            'role' => 'admin',
        ]);
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
        $user = User::create([
            'Nama' => $data['nama'],
            'email' => $data['email'],
            'username' => $data['username'],
            'division_id' => $data['division_id'],
            'password' => bcrypt($data['password']),
            'role' => 'auditor',
        ]);
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
            'name' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'division_id' => 'required|integer',
            'role' => 'nullable|in:admin,staff,auditor',
        ]);

        $nama = $data['nama'] ?? $data['name'] ?? null;

        $user = User::create([
            'Nama' => $nama,
            'email' => $data['email'],
            'username' => $data['username'],
            'division_id' => $data['division_id'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'staff',
        ]);

        if ($this->isApi($request)) {
            return response()->json($user, 201);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $divisions = Division::orderBy('Nama_Divisi')->get();

        return view('admin.users.edit', compact('user', 'divisions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$user->user_id.',user_id',
            'username' => 'sometimes|string|max:255|unique:users,username,'.$user->user_id.',user_id',
            'password' => 'nullable|string|min:8',
            'division_id' => 'sometimes|integer',
            'role' => 'nullable|in:admin,staff,auditor',
        ]);

        if (array_key_exists('nama', $data) || array_key_exists('name', $data)) {
            $data['Nama'] = $data['nama'] ?? $data['name'];
        }

        unset($data['nama'], $data['name']);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if ($this->isApi($request)) {
            return response()->json($user);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($this->isApi($request)) {
        return response()->json(['message' => 'Deleted successfully']);
        }

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
