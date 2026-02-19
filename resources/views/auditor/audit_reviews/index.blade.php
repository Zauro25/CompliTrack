@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Audit Reviews</h1>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Compliance ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Staff</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Auditor</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($reviews as $review)
                    <tr>
                        <td class="px-4 py-3">#{{ $review->audit_review_id }}</td>
                        <td class="px-4 py-3">{{ $review->compliance_id }}</td>
                        <td class="px-4 py-3">{{ $review->complianceEntry?->user?->Nama }}</td>
                        <td class="px-4 py-3">{{ $review->auditor?->Nama }}</td>
                        <td class="px-4 py-3">{{ $review->status }}</td>
                        <td class="px-4 py-3"><a href="{{ route('auditor.audit-reviews.show', $review->audit_review_id) }}" class="text-blue-600 hover:underline">Open Review</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">No audit reviews found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $reviews->links() }}</div>
    </div>
</div>
@endsection
