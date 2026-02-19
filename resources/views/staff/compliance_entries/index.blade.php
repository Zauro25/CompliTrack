@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">My Compliance Entries</h1>
        <a href="{{ route('staff.compliance-entries.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Add Entry</a>
    </div>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Checklist</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Audit Result</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Checked At</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($entries as $entry)
                    <tr>
                        <td class="px-4 py-3">{{ $entry->checklist?->Judul_Checklist }}</td>
                        <td class="px-4 py-3">{{ $entry->status }}</td>
                        <td class="px-4 py-3">
                            {{ $entry->latestAuditReview?->status ? str_replace('_', ' ', ucfirst($entry->latestAuditReview->status)) : '-' }}
                        </td>
                        <td class="px-4 py-3">{{ $entry->checked_at?->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3"><a href="{{ route('staff.compliance-entries.show', $entry->compliance_id) }}" class="text-blue-600 hover:underline">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">No entries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $entries->links() }}</div>
    </div>
</div>
@endsection
