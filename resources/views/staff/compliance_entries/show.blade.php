@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Compliance Entry Detail</h1>
    <div class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        <div>
            <p class="text-sm text-gray-500">Checklist</p>
            <p class="font-semibold">{{ $entry->checklist?->Judul_Checklist }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Status</p>
            <p>{{ $entry->status }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Note</p>
            <p>{{ $entry->note ?: '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Checked At</p>
            <p>{{ $entry->checked_at?->format('d M Y H:i') }}</p>
        </div>
        <div class="border-t pt-4">
            <p class="text-sm text-gray-500">Latest Audit Result</p>
            <p class="font-semibold">
                {{ $entry->latestAuditReview?->status ? str_replace('_', ' ', ucfirst($entry->latestAuditReview->status)) : 'Not reviewed yet' }}
            </p>
            <p class="mt-1 text-sm text-gray-600">{{ $entry->latestAuditReview?->notes ?: '-' }}</p>
            <p class="mt-1 text-xs text-gray-500">
                @if($entry->latestAuditReview)
                    Reviewed by {{ $entry->latestAuditReview?->auditor?->Nama }} at {{ $entry->latestAuditReview?->reviewed_at?->format('d M Y H:i') }}
                @endif
            </p>
        </div>
        <div>
            <a href="{{ route('staff.compliance-entries.index') }}" class="rounded border px-4 py-2 text-sm">Back</a>
        </div>
    </div>
</div>
@endsection
