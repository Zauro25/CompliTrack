@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center landing-hero">
    <div class="max-w-xl w-full text-center py-16">
        <h1 class="text-4xl font-bold mb-4 text-white">Welcome to CompliTrack</h1>
        <p class="mb-8 font-semibold text-lg text-white">Your internal Policy and Compliance Management System</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('login') }}" class="btn-ghost block p-4 border border-secondary rounded-lg shadow text-white bg-green-600 hover:bg-blue-600 transition">Login</a>
            <a href="{{ route('register') }}" class="btn-secondary block p-4 border border-secondary rounded-lg shadow text-white bg-yellow-700 hover:bg-orange-600 transition">Register</a>
        </div>
    </div>
</div>
@endsection
