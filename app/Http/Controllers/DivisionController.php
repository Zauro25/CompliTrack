<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return response()->json($divisions);
    }

    public function show($id)
    {
        $division = Division::findOrFail($id);
        return response()->json($division);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nama_Divisi' => 'required|string',
            'Deskripsi' => 'nullable|string',
        ]);
        $division = Division::create($data);
        return response()->json($division, 201);
    }

    public function update(Request $request, $id)
    {
        $division = Division::findOrFail($id);
        $data = $request->validate([
            'Nama_Divisi' => 'sometimes|string',
            'Deskripsi' => 'nullable|string',
        ]);
        $division->update($data);
        return response()->json($division);
    }

    public function destroy($id)
    {
        $division = Division::findOrFail($id);
        $division->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
