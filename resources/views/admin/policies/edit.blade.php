@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Edit Policy</h1>
    <form method="POST" action="{{ route('admin.policies.update', $policy->policies_id) }}" class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div>
            <label class="mb-1 block text-sm font-medium">Division</label>
            <select name="division_id" class="w-full rounded border px-3 py-2" required>
                @foreach($divisions as $division)
                    <option value="{{ $division->division_id }}" @selected(old('division_id', $policy->division_id) == $division->division_id)>{{ $division->Nama_Divisi }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Title</label>
            <input type="text" name="Judul" value="{{ old('Judul', $policy->Judul) }}" class="w-full rounded border px-3 py-2" required>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Description</label>
            <textarea name="Deskripsi" class="w-full rounded border px-3 py-2" rows="4">{{ old('Deskripsi', $policy->Deskripsi) }}</textarea>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Status</label>
            <select name="Status" class="w-full rounded border px-3 py-2" required>
                <option value="draft" @selected(old('Status', $policy->Status) === 'draft')>Draft</option>
                <option value="active" @selected(old('Status', $policy->Status) === 'active')>Active</option>
                <option value="archived" @selected(old('Status', $policy->Status) === 'archived')>Archived</option>
            </select>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.policies.index') }}" class="rounded border px-4 py-2 text-sm">Cancel</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Update</button>
        </div>
    </form>
</div>
@endsection
