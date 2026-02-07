@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-primary mb-6">Staff Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('staff.checklists.index') }}" class="block p-6 bg-white border border-secondary rounded-lg shadow hover:bg-secondary hover:text-white transition">
            <div class="font-semibold text-lg">My Checklists</div>
            <div class="text-sm text-gray-500">View and complete assigned compliance checklists.</div>
        </a>
        <a href="{{ route('staff.evidences.index') }}" class="block p-6 bg-white border border-secondary rounded-lg shadow hover:bg-secondary hover:text-white transition">
            <div class="font-semibold text-lg">Upload Evidence</div>
            <div class="text-sm text-gray-500">Upload and manage evidence for compliance.</div>
        </a>
    </div>
</div>
@endsection
