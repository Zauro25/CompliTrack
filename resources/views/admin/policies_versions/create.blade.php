@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Add Policy Version</h1>
    <form method="POST" action="{{ route('admin.policies-versions.store') }}" class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf
        <div>
            <label class="mb-1 block text-sm font-medium">Policy</label>
            <select name="policies_id" class="w-full rounded border px-3 py-2" required>
                <option value="">Select policy</option>
                @foreach($policies as $policy)
                    <option value="{{ $policy->policies_id }}" @selected(old('policies_id') == $policy->policies_id)>{{ $policy->Judul }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Version Number</label>
            <input type="text" name="version_number" value="{{ old('version_number') }}" class="w-full rounded border px-3 py-2" required>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Document Path</label>
            <input type="text" name="document_path" value="{{ old('document_path') }}" class="w-full rounded border px-3 py-2" required>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Effective Date</label>
            <input type="date" name="effective_date" value="{{ old('effective_date') }}" class="w-full rounded border px-3 py-2" required>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.policies-versions.index') }}" class="rounded border px-4 py-2 text-sm">Cancel</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Save</button>
        </div>
    </form>
</div>
@endsection
