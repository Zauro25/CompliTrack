@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 space-y-6">
    <h1 class="text-3xl font-bold text-primary mb-12 text-white text-center">Staff Dashboard</h1>
    <div class="grid pt-6 gap-6 mb-12">
        <p class="p-4 bg-white rounded shadow text-center font-semibold">Divisi: {{$divisionName}} </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('staff.checklists.index') }}" class="block p-6 bg-white border border-secondary rounded-lg shadow hover:bg-secondary hover:text-white transition">
            <div class="font-semibold text-lg text-center">My Checklists</div>
            <div class="text-sm text-gray-500 text-center">View and complete assigned compliance checklists.</div>
        </a>
        <a href="{{ route('staff.evidences.index') }}" class="block p-6 bg-white border border-secondary rounded-lg shadow hover:bg-secondary hover:text-white transition">
            <div class="font-semibold text-lg text-center">Upload Evidence</div>
            <div class="text-sm text-gray-500 text-center">Upload and manage evidence for compliance.</div>
        </a>
    </div>
</div>
@endsection
