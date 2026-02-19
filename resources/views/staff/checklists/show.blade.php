@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Checklist Detail</h1>
    <div class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        <div>
            <p class="text-sm text-gray-500">Checklist</p>
            <p class="font-semibold">{{ $checklist->Judul_Checklist }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Policy</p>
            <p>{{ $checklist->policiesVersion?->policies?->Judul }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Description</p>
            <p>{{ $checklist->Deskripsi }}</p>
        </div>
        <div class="pt-2">
            <a href="{{ route('staff.checklists.edit', $checklist->checklist_id) }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Fill Checklist</a>
        </div>
    </div>
</div>
@endsection
