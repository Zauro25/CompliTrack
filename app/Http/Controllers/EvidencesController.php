<?php

namespace App\Http\Controllers;

use App\Models\Evidences;
use Illuminate\Http\Request;

class EvidencesController extends Controller
{
    public function index()
    {
        $evidences = Evidences::all();
        return response()->json($evidences);
    }

    public function show($id)
    {
        $evidence = Evidences::findOrFail($id);
        return response()->json($evidence);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'compliance_id' => 'required|integer',
            'file_path' => 'required|string',
        ]);
        $evidence = Evidences::create($data);
        return response()->json($evidence, 201);
    }

    public function update(Request $request, $id)
    {
        $evidence = Evidences::findOrFail($id);
        $data = $request->validate([
            'compliance_id' => 'sometimes|integer',
            'file_path' => 'sometimes|string',
        ]);
        $evidence->update($data);
        return response()->json($evidence);
    }

    public function destroy($id)
    {
        $evidence = Evidences::findOrFail($id);
        $evidence->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
