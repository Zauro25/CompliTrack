@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">My Policies</h1>
    <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Description</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($policies as $policy)
                    <tr>
                        <td class="px-4 py-3">{{ $policy->Judul }}</td>
                        <td class="px-4 py-3">{{ $policy->Deskripsi }}</td>
                        <td class="px-4 py-3">{{ $policy->Status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-4 py-6 text-center text-sm text-gray-500">No policies assigned.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $policies->links() }}</div>
    </div>
</div>
@endsection
