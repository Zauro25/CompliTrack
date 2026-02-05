<?php

namespace App\Http\Controllers;

use App\Models\Checklists;
use Illuminate\Http\Request;

class ChecklistsController extends Controller
{
    public function index()
    {
        $checklists = Checklists::all();
        return response()->json($checklists);
    }

    public function show($id)
    {
        $checklist = Checklists::findOrFail($id);
        return response()->json($checklist);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'version_id' => 'required|integer',
            'Judul_Checklist' => 'required|string',
            'Deskripsi' => 'nullable|string',
            'required' => 'required|boolean',
        ]);
        $checklist = Checklists::create($data);
        return response()->json($checklist, 201);
    }

    public function update(Request $request, $id)
    {
        $checklist = Checklists::findOrFail($id);
        $data = $request->validate([
            'version_id' => 'sometimes|integer',
            'Judul_Checklist' => 'sometimes|string',
            'Deskripsi' => 'nullable|string',
            'required' => 'sometimes|boolean',
        ]);
        $checklist->update($data);
        return response()->json($checklist);
    }

    public function destroy($id)
    {
        $checklist = Checklists::findOrFail($id);
        $checklist->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
