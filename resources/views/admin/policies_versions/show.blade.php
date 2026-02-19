@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Policy Version Detail</h1>
    <div class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        <div>
            <p class="text-sm text-gray-500">Policy</p>
            <p class="font-semibold">{{ $version->policies?->Judul }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Version</p>
            <p class="font-semibold">{{ $version->version_number }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Document Path</p>
            <p>{{ $version->document_path }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Effective Date</p>
            <p>{{ $version->effective_date?->format('d M Y') }}</p>
        </div>
        <div class="pt-2">
            <a href="{{ route('admin.policies-versions.index') }}" class="rounded border px-4 py-2 text-sm">Back</a>
        </div>
    </div>
</div>
@endsection
