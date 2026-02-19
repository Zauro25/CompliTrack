@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-primary mb-6">Add User</h1>
    <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
            @error('name')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
            @error('username')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
            @error('email')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Division</label>
            <select name="division_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
                <option value="">Select division</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->division_id }}" @selected(old('division_id') == $division->division_id)>{{ $division->Nama_Divisi }}</option>
                @endforeach
            </select>
            @error('division_id')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
                <option value="">Select role</option>
                <option value="admin" @selected(old('role')=='admin')>Admin</option>
                <option value="staff" @selected(old('role')=='staff')>Staff</option>
                <option value="auditor" @selected(old('role')=='auditor')>Auditor</option>
            </select>
            @error('role')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
            @error('password')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-600">Create User</button>
        </div>
    </form>
</div>
@endsection
