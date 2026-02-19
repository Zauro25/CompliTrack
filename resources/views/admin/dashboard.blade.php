@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Total Users</p>
            <p class="text-2xl font-bold">{{ $totalUser }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Total Divisions</p>
            <p class="text-2xl font-bold">{{ $totalDivision }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Total Policies</p>
            <p class="text-2xl font-bold">{{ $totalPolicies }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Total Evidences</p>
            <p class="text-2xl font-bold">{{ $totalEvidences }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Total Audit Reviews</p>
            <p class="text-2xl font-bold">{{ $totalAuditReviews }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Needs Fix Reviews</p>
            <p class="text-2xl font-bold">{{ $needsFixReviews }}</p>
        </div>
    </div>

    <div class="mb-8 overflow-x-auto rounded-lg border bg-white shadow-sm">
        <div class="border-b px-4 py-3">
            <h2 class="text-lg font-semibold">Recent Audit Results</h2>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Compliance ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Staff</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Auditor</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Result</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Reviewed At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentAuditReviews as $review)
                    <tr>
                        <td class="px-4 py-3">{{ $review->compliance_id }}</td>
                        <td class="px-4 py-3">{{ $review->complianceEntry?->user?->Nama }}</td>
                        <td class="px-4 py-3">{{ $review->auditor?->Nama }}</td>
                        <td class="px-4 py-3">{{ str_replace('_', ' ', ucfirst($review->status)) }}</td>
                        <td class="px-4 py-3">{{ $review->reviewed_at?->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">No audit result available yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.users.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg">Manage Users</div>
            <div class="text-sm text-gray-500">Add, edit, or remove users and assign roles.</div>
        </a>
        <a href="{{ route('admin.divisions.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg">Manage Divisions</div>
            <div class="text-sm text-gray-500">Create and organize company divisions.</div>
        </a>
        <a href="{{ route('admin.policies.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg">Manage Policies</div>
            <div class="text-sm text-gray-500">Create, update, and assign policies.</div>
        </a>
        <a href="{{ route('admin.policies-versions.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg">Policy Versions</div>
            <div class="text-sm text-gray-500">Track and manage policy versions.</div>
        </a>
    </div>
</div>
@endsection
