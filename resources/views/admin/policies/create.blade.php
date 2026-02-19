@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Add Policy</h1>
    <form method="POST" action="{{ route('admin.policies.store') }}" class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf
        <div>
            <label class="mb-1 block text-sm font-medium">Division</label>
            <select name="division_id" class="w-full rounded border px-3 py-2" required>
                <option value="">Select division</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->division_id }}" @selected(old('division_id') == $division->division_id)>{{ $division->Nama_Divisi }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Title</label>
            <input type="text" name="Judul" value="{{ old('Judul') }}" class="w-full rounded border px-3 py-2" required>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Description</label>
            <textarea name="Deskripsi" class="w-full rounded border px-3 py-2" rows="4">{{ old('Deskripsi') }}</textarea>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Status</label>
            <select name="Status" class="w-full rounded border px-3 py-2" required>
                <option value="draft">Draft</option>
                <option value="active">Active</option>
                <option value="archived">Archived</option>
            </select>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.policies.index') }}" class="rounded border px-4 py-2 text-sm">Cancel</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Save</button>
        </div>
    </form>
</div>
@endsection
