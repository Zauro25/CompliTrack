@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Upload Evidence</h1>

    <form action="{{ route('staff.evidences.store') }}" method="POST" enctype="multipart/form-data" class="rounded-lg border bg-white p-6 shadow-sm space-y-4">
        @csrf

        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">Compliance Entry</label>
            <select name="compliance_id" class="w-full rounded border border-gray-300 px-3 py-2" required>
                <option value="">Select entry</option>
                @foreach($entries as $entry)
                    <option value="{{ $entry->compliance_id }}" @selected(old('compliance_id') == $entry->compliance_id)>
                        #{{ $entry->compliance_id }} - {{ $entry->checklist?->Judul_Checklist ?? 'Checklist' }}
                    </option>
                @endforeach
            </select>
            @error('compliance_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">File</label>
            <input type="file" name="file" class="w-full rounded border border-gray-300 px-3 py-2" required>
            @error('file')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('staff.evidences.index') }}" class="rounded border px-4 py-2 text-sm">Cancel</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-black">Upload</button>
        </div>
    </form>
</div>
@endsection