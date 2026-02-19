@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Evidences</h1>
        <a href="{{ route('staff.evidences.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-black">Upload Evidence</a>
    </div>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Compliance ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">File</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Uploaded</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($evidences as $evidence)
                    <tr>
                        <td class="px-4 py-3">{{ $evidence->compliance_id }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('staff.evidences.file', $evidence->evidence_id) }}" target="_blank" class="text-blue-600 hover:underline">View File</a>
                        </td>
                        <td class="px-4 py-3">{{ $evidence->created_at?->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('staff.evidences.destroy', $evidence->evidence_id) }}" method="POST" onsubmit="return confirm('Delete this evidence?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No evidences uploaded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">{{ $evidences->links() }}</div>
    </div>
</div>
@endsection
