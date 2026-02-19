@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Auditor Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Total Audit Reviews</p>
            <p class="text-2xl font-bold">{{ $totalAuditReviews }}</p>
        </div>
        <div class="rounded-lg border bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Needs Fix</p>
            <p class="text-2xl font-bold">{{ $needsFixReviews }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('auditor.compliance-entries.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg">Review Compliance Entries</div>
            <div class="text-sm text-gray-500">Review, approve, or request fixes for compliance entries.</div>
        </a>
        <a href="{{ route('auditor.audit-reviews.index') }}" class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100 transition">
            <div class="font-semibold text-lg">Audit Logs</div>
            <div class="text-sm text-gray-500">View audit logs and evidence.</div>
        </a>
    </div>
</div>
@endsection
