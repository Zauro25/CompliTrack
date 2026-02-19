@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="mb-6 text-2xl font-bold">Create Compliance Entry</h1>
    <form method="POST" action="{{ route('staff.compliance-entries.store') }}" class="space-y-4 rounded-lg border bg-white p-6 shadow-sm">
        @csrf
        <div>
            <label class="mb-1 block text-sm font-medium">Checklist</label>
            <select name="checklist_id" class="w-full rounded border px-3 py-2" required>
                <option value="">Select checklist</option>
                @foreach($checklists as $checklist)
                    <option value="{{ $checklist->checklist_id }}" @selected(old('checklist_id') == $checklist->checklist_id)>
                        {{ $checklist->Judul_Checklist }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Status</label>
            <select name="status" class="w-full rounded border px-3 py-2" required>
                <option value="pending">Pending</option>
                <option value="compliant">Compliant</option>
                <option value="non_compliant">Non Compliant</option>
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Note</label>
            <textarea name="note" class="w-full rounded border px-3 py-2" rows="4">{{ old('note') }}</textarea>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('staff.compliance-entries.index') }}" class="rounded border px-4 py-2 text-sm">Cancel</a>
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Save</button>
        </div>
    </form>
</div>
@endsection
