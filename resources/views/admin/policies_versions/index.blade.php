@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Policy Versions</h1>
        <a href="{{ route('admin.policies-versions.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-black">Add Version</a>
    </div>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Policy</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Version</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Effective Date</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($versions as $version)
                    <tr>
                        <td class="px-4 py-3">{{ $version->policies?->Judul }}</td>
                        <td class="px-4 py-3">{{ $version->version_number }}</td>
                        <td class="px-4 py-3">{{ $version->effective_date?->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.policies-versions.show', $version->version_id) }}" class="mr-2 text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.policies-versions.edit', $version->version_id) }}" class="mr-2 text-green-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.policies-versions.destroy', $version->version_id) }}" method="POST" class="inline" onsubmit="return confirm('Delete version?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No versions found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $versions->links() }}</div>
    </div>
</div>
@endsection
