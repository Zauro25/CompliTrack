@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-50">
    <div class="max-w-xl w-full text-center py-16">
        <h1 class="text-4xl font-bold text-primary mb-4">Welcome to CompliTrack</h1>
        <p class="mb-8 text-lg text-gray-700">Your internal Policy and Compliance Management System</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('login') }}" class="btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn-secondary">Register as Staff</a>
        </div>
    </div>
</div>
@endsection
