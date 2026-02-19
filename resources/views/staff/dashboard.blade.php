@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 space-y-6">
    <h1 class="text-3xl font-bold mb-6">Staff Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Division</p>
            <p class="text-lg font-semibold">{{ $divisionName }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Policies</p>
            <p class="text-2xl font-bold">{{ $totalPolicies }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Checklists</p>
            <p class="text-2xl font-bold">{{ $totalChecklist }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Evidences</p>
            <p class="text-2xl font-bold">{{ $totalEvidences }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('staff.checklists.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg text-center">My Checklists</div>
            <div class="text-sm text-gray-500 text-center">View and complete assigned compliance checklists.</div>
        </a>
        <a href="{{ route('staff.evidences.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg text-center">Upload Evidence</div>
            <div class="text-sm text-gray-500 text-center">Upload and manage evidence for compliance.</div>
        </a>
    </div>
</div>
@endsection
