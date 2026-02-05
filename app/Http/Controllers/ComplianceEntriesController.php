<?php

namespace App\Http\Controllers;

use App\Models\ComplianceEntries;
use Illuminate\Http\Request;

class ComplianceEntriesController extends Controller
{
    public function index()
    {
        $entries = ComplianceEntries::all();
        return response()->json($entries);
    }

    public function show($id)
    {
        $entry = ComplianceEntries::findOrFail($id);
        return response()->json($entry);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'checklist_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);
        $entry = ComplianceEntries::create($data);
        return response()->json($entry, 201);
    }

    public function update(Request $request, $id)
    {
        $entry = ComplianceEntries::findOrFail($id);
        $data = $request->validate([
            'checklist_id' => 'sometimes|integer',
            'user_id' => 'sometimes|integer',
            'status' => 'sometimes|string',
            'note' => 'nullable|string',
        ]);
        $entry->update($data);
        return response()->json($entry);
    }

    public function destroy($id)
    {
        $entry = ComplianceEntries::findOrFail($id);
        $entry->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
