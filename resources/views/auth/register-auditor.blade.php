@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-primary mb-6">Register Auditor</h1>
    <form method="POST" action="{{ route('register.auditor') }}" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
            @error('nama')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Username (Email)</label>
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
                @foreach ($divisions as $division)
                    <option value="{{ $division->division_id }}" @selected(old('division_id') == $division->division_id)>
                        {{ $division->Nama_Divisi }}
                    </option>
                @endforeach
            </select>
            @error('division_id')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
            @error('password')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn-primary">Register Auditor</button>
        </div>
    </form>
</div>
@endsection
