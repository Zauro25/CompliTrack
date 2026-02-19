@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Policies</h1>
        <a href="{{ route('admin.policies.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-black">Add Policy</a>
    </div>

    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Division</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($policies as $policy)
                    <tr>
                        <td class="px-4 py-3">{{ $policy->Judul }}</td>
                        <td class="px-4 py-3">{{ $policy->division?->Nama_Divisi }}</td>
                        <td class="px-4 py-3"><span class="rounded bg-gray-100 px-2 py-1 text-xs">{{ $policy->Status }}</span></td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.policies.show', $policy->policies_id) }}" class="mr-2 text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.policies.edit', $policy->policies_id) }}" class="mr-2 text-green-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.policies.destroy', $policy->policies_id) }}" method="POST" class="inline" onsubmit="return confirm('Delete policy?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No policies found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $policies->links() }}</div>
    </div>
</div>
@endsection
