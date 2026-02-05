<?php

namespace App\Http\Controllers;

use App\Models\Policies;
use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    public function index()
    {
        $policies = Policies::all();
        return response()->json($policies);
    }

    public function show($id)
    {
        $policy = Policies::findOrFail($id);
        return response()->json($policy);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'division_id' => 'required|integer',
            'Judul' => 'required|string',
            'Deskripsi' => 'nullable|string',
            'Status' => 'required|string',
        ]);
        $policy = Policies::create($data);
        return response()->json($policy, 201);
    }

    public function update(Request $request, $id)
    {
        $policy = Policies::findOrFail($id);
        $data = $request->validate([
            'division_id' => 'sometimes|integer',
            'Judul' => 'sometimes|string',
            'Deskripsi' => 'nullable|string',
            'Status' => 'sometimes|string',
        ]);
        $policy->update($data);
        return response()->json($policy);
    }

    public function destroy($id)
    {
        $policy = Policies::findOrFail($id);
        $policy->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
