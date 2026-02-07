@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-primary mb-6">Auditor Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('auditor.compliance-entries.index') }}" class="block p-6 bg-white border border-primary rounded-lg shadow hover:bg-primary hover:text-white transition">
            <div class="font-semibold text-lg">Review Compliance Entries</div>
            <div class="text-sm text-gray-500">Review, approve, or request fixes for compliance entries.</div>
        </a>
        <a href="{{ route('auditor.audit-reviews.index') }}" class="block p-6 bg-white border border-secondary rounded-lg shadow hover:bg-secondary hover:text-white transition">
            <div class="font-semibold text-lg">Audit Logs</div>
            <div class="text-sm text-gray-500">View audit logs and evidence.</div>
        </a>
    </div>
</div>
@endsection
