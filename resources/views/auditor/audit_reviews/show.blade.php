@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Audit Review Detail</h1>

    <div class="mb-6 space-y-3 rounded-lg border bg-white p-6 shadow-sm">
        <div>
            <p class="text-sm text-gray-500">Audit Review ID</p>
            <p class="font-semibold">#{{ $review->audit_review_id }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Compliance ID</p>
            <p>{{ $review->compliance_id }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Current Status</p>
            <p>{{ $review->status }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('auditor.audit-reviews.update', $review->audit_review_id) }}" class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div>
            <label class="mb-1 block text-sm font-medium">Status</label>
            <select name="status" class="w-full rounded border px-3 py-2" required>
                <option value="approved" @selected($review->status === 'approved')>Approved</option>
                <option value="needs_fix" @selected($review->status === 'needs_fix')>Needs Fix</option>
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Notes</label>
            <textarea name="notes" class="w-full rounded border px-3 py-2" rows="4">{{ old('notes', $review->notes) }}</textarea>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('auditor.audit-reviews.index') }}" class="rounded border px-4 py-2 text-sm">Back</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Update</button>
        </div>
    </form>
</div>
@endsection
