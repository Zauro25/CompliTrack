<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(Division::all());
        }

        $divisions = Division::latest()->paginate(10);

        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function show($id)
    {
        $division = Division::findOrFail($id);
        return response()->json($division);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'Nama_Divisi' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'Deskripsi' => 'nullable|string',
        ]);

        $division = Division::create([
            'Nama_Divisi' => $data['Nama_Divisi'] ?? $data['name'] ?? '',
            'Deskripsi' => $data['Deskripsi'] ?? $data['description'] ?? null,
        ]);

        if ($this->isApi($request)) {
            return response()->json($division, 201);
        }

        return redirect()->route('admin.divisions.index')->with('success', 'Division created successfully.');
    }

    public function edit($id)
    {
        $division = Division::findOrFail($id);

        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, $id)
    {
        $division = Division::findOrFail($id);
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'Nama_Divisi' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'Deskripsi' => 'nullable|string',
        ]);

        $division->update([
            'Nama_Divisi' => $data['Nama_Divisi'] ?? $data['name'] ?? $division->Nama_Divisi,
            'Deskripsi' => $data['Deskripsi'] ?? $data['description'] ?? $division->Deskripsi,
        ]);

        if ($this->isApi($request)) {
            return response()->json($division);
        }

        return redirect()->route('admin.divisions.index')->with('success', 'Division updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $division = Division::findOrFail($id);
        $division->delete();

        if ($this->isApi($request)) {
        return response()->json(['message' => 'Deleted successfully']);
        }

        return redirect()->route('admin.divisions.index')->with('success', 'Division deleted successfully.');
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
