@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-primary mb-6">Edit Division</h1>
    <form method="POST" action="{{ route('admin.divisions.update', $division) }}" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $division->name) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>
            @error('name')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-primary focus:border-primary" required>{{ old('description', $division->description) }}</textarea>
            @error('description')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-600">Update Division</button>
        </div>
    </form>
</div>
@endsection
