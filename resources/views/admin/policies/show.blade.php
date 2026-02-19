@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Policy Detail</h1>
    <div class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        <div>
            <p class="text-sm text-gray-500">Title</p>
            <p class="font-semibold">{{ $policy->Judul }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Division</p>
            <p class="font-semibold">{{ $policy->division?->Nama_Divisi }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Status</p>
            <p class="font-semibold">{{ $policy->Status }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Description</p>
            <p>{{ $policy->Deskripsi }}</p>
        </div>
        <div class="pt-2">
            <a href="{{ route('admin.policies.index') }}" class="rounded border px-4 py-2 text-sm">Back</a>
        </div>
    </div>
</div>
@endsection
