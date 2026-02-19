@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Review Compliance Entry</h1>

    <div class="mb-6 space-y-3 rounded-lg border bg-white p-6 shadow-sm">
        <div>
            <p class="text-sm text-gray-500">User</p>
            <p class="font-semibold">{{ $entry->user?->Nama }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Checklist</p>
            <p>{{ $entry->checklist?->Judul_Checklist }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Current Status</p>
            <p>{{ $entry->status }}</p>
        </div>
    </div>

    <div class="mb-6 rounded-lg border bg-white p-6 shadow-sm">
        <h2 class="mb-3 text-lg font-semibold">Evidences</h2>
        <div class="space-y-2">
            @forelse($entry->evidences as $evidence)
                <div class="flex items-center justify-between rounded border px-3 py-2">
                    <div>
                        <p class="text-sm font-medium">Evidence #{{ $evidence->evidence_id }}</p>
                        <p class="text-xs text-gray-500">{{ $evidence->created_at?->format('d M Y H:i') }}</p>
                    </div>
                    <a href="{{ route('auditor.evidences.file', $evidence->evidence_id) }}" target="_blank" class="text-blue-600 hover:underline">View File</a>
                </div>
            @empty
                <p class="text-sm text-gray-500">No evidence uploaded yet.</p>
            @endforelse
        </div>
    </div>

    <form method="POST" action="{{ route('auditor.compliance-entries.update', $entry->compliance_id) }}" class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div>
            <label class="mb-1 block text-sm font-medium">Update Status</label>
            <select name="status" class="w-full rounded border px-3 py-2" required>
                <option value="pending" @selected($entry->status === 'pending')>Pending</option>
                <option value="compliant" @selected($entry->status === 'compliant')>Compliant</option>
                <option value="non_compliant" @selected($entry->status === 'non_compliant')>Non Compliant</option>
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Auditor Note</label>
            <textarea name="note" class="w-full rounded border px-3 py-2" rows="4">{{ old('note', $entry->note) }}</textarea>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('auditor.compliance-entries.index') }}" class="rounded border px-4 py-2 text-sm">Back</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Update</button>
        </div>
    </form>

    <form method="POST" action="{{ route('auditor.audit-reviews.store') }}" class="mt-6 space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf
        <input type="hidden" name="compliance_id" value="{{ $entry->compliance_id }}">

        <h2 class="text-lg font-semibold">Audit Review</h2>

        <div>
            <label class="mb-1 block text-sm font-medium">Review Status</label>
            <select name="status" class="w-full rounded border px-3 py-2" required>
                <option value="approved" @selected(optional($existingReview)->status === 'approved')>Approved</option>
                <option value="needs_fix" @selected(optional($existingReview)->status === 'needs_fix')>Needs Fix</option>
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Review Notes</label>
            <textarea name="notes" class="w-full rounded border px-3 py-2" rows="4">{{ old('notes', optional($existingReview)->notes) }}</textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Save Audit Review</button>
        </div>
    </form>
</div>
@endsection
