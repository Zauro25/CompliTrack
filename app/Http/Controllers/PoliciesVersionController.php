<?php

namespace App\Http\Controllers;

use App\Models\PoliciesVersion;
use Illuminate\Http\Request;

class PoliciesVersionController extends Controller
{
    public function index()
    {
        $versions = PoliciesVersion::all();
        return response()->json($versions);
    }

    public function show($id)
    {
        $version = PoliciesVersion::findOrFail($id);
        return response()->json($version);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'policies_id' => 'required|integer',
            'version_number' => 'required|string',
            'document_path' => 'required|string',
            'effective_date' => 'required|date',
        ]);
        $version = PoliciesVersion::create($data);
        return response()->json($version, 201);
    }

    public function update(Request $request, $id)
    {
        $version = PoliciesVersion::findOrFail($id);
        $data = $request->validate([
            'policies_id' => 'sometimes|integer',
            'version_number' => 'sometimes|string',
            'document_path' => 'sometimes|string',
            'effective_date' => 'sometimes|date',
        ]);
        $version->update($data);
        return response()->json($version);
    }

    public function destroy($id)
    {
        $version = PoliciesVersion::findOrFail($id);
        $version->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
