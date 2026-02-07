@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-primary mb-6">Admin Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.users.index') }}" class="block p-6 bg-white border border-primary rounded-lg shadow hover:bg-primary hover:text-white transition">
            <div class="font-semibold text-lg">Manage Users</div>
            <div class="text-sm text-gray-500">Add, edit, or remove users and assign roles.</div>
        </a>
        <a href="{{ route('admin.divisions.index') }}" class="block p-6 bg-white border border-primary rounded-lg shadow hover:bg-primary hover:text-white transition">
            <div class="font-semibold text-lg">Manage Divisions</div>
            <div class="text-sm text-gray-500">Create and organize company divisions.</div>
        </a>
        <a href="{{ route('admin.policies.index') }}" class="block p-6 bg-white border border-primary rounded-lg shadow hover:bg-primary hover:text-white transition">
            <div class="font-semibold text-lg">Manage Policies</div>
            <div class="text-sm text-gray-500">Create, update, and assign policies.</div>
        </a>
        <a href="{{ route('admin.policies-versions.index') }}" class="block p-6 bg-white border border-primary rounded-lg shadow hover:bg-primary hover:text-white transition">
            <div class="font-semibold text-lg">Policy Versions</div>
            <div class="text-sm text-gray-500">Track and manage policy versions.</div>
        </a>
    </div>
</div>
@endsection
