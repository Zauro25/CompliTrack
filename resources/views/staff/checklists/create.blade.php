@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Add Checklist</h1>

    <form method="POST" action="{{ route('staff.checklists.store') }}" class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf

        <div>
            <label class="mb-1 block text-sm font-medium">Policy Version</label>
            <select name="version_id" class="w-full rounded border px-3 py-2" required>
                <option value="">Select version</option>
                @foreach($versions as $version)
                    <option value="{{ $version->version_id }}" @selected(old('version_id') == $version->version_id)>
                        {{ $version->policies?->Judul }} - v{{ $version->version_number }}
                    </option>
                @endforeach
            </select>
            @error('version_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Checklist Title</label>
            <input type="text" name="Judul_Checklist" value="{{ old('Judul_Checklist') }}" class="w-full rounded border px-3 py-2" required>
            @error('Judul_Checklist')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Description</label>
            <textarea name="Deskripsi" rows="4" class="w-full rounded border px-3 py-2">{{ old('Deskripsi') }}</textarea>
            @error('Deskripsi')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Is Required?</label>
            <select name="required" class="w-full rounded border px-3 py-2" required>
                <option value="1" @selected(old('required') === '1')>Yes</option>
                <option value="0" @selected(old('required') === '0')>No</option>
            </select>
            @error('required')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('staff.checklists.index') }}" class="rounded border px-4 py-2 text-sm">Cancel</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Save Checklist</button>
        </div>
    </form>
</div>
@endsection
