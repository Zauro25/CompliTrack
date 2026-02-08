@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 space-y-6">
    <h1 class="text-3xl font-bold text-primary mb-12 text-white text-center">Staff Dashboard</h1>
    <div class="flex flex-col items-center gap-6 mb-12">
        <p class="p-4 bg-white rounded shadow text-center font-semibold">Divisi: {{$divisionName}} </p>
    </div>
    <div class="flex flex-col items-center md:grid-cols-2 pt-6">
        <form action="{{ route('staff.evidences.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            <input type="file" name="file" class="block p-6 bg-white border border-secondary rounded-lg shadow hover:bg-secondary hover:text-gray text-center transition" required>
            <input type="number" name="compliance_id" class="block p-6 bg-white border border-secondary rounded-lg shadow hover:bg-secondary text-black text-center transition" required placeholder="Compliance ID">
            <button type="submit" class="block p-6 pt-6 bg-green-600 border border-secondary rounded-lg shadow hover:bg-blue-600 text-white hover:text-gray transition">
                Upload
            </button>
        </form>
</div>
@endsection
