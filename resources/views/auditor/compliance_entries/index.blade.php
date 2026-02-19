@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Compliance Entries</h1>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">User</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Checklist</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($entries as $entry)
                    <tr>
                        <td class="px-4 py-3">#{{ $entry->compliance_id }}</td>
                        <td class="px-4 py-3">{{ $entry->user?->Nama }}</td>
                        <td class="px-4 py-3">{{ $entry->checklist?->Judul_Checklist }}</td>
                        <td class="px-4 py-3">{{ $entry->status }}</td>
                        <td class="px-4 py-3"><a href="{{ route('auditor.compliance-entries.show', $entry->compliance_id) }}" class="text-blue-600 hover:underline">Review</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">No compliance entries found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $entries->links() }}</div>
    </div>
</div>
@endsection
