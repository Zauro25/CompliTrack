@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">My Checklists</h1>
        <a href="{{ route('staff.checklists.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-black">Add Checklist</a>
    </div>
    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Checklist</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Policy</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Required</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($checklists as $checklist)
                    <tr>
                        <td class="px-4 py-3">{{ $checklist->Judul_Checklist }}</td>
                        <td class="px-4 py-3">{{ $checklist->policiesVersion?->policies?->Judul }}</td>
                        <td class="px-4 py-3">{{ $checklist->required ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('staff.checklists.show', $checklist->checklist_id) }}" class="mr-2 text-blue-600 hover:underline">View</a>
                            <a href="{{ route('staff.checklists.edit', $checklist->checklist_id) }}" class="text-green-600 hover:underline">Fill</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No checklists available.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $checklists->links() }}</div>
    </div>
</div>
@endsection
