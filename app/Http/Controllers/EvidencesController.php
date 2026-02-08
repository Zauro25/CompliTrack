<?php

namespace App\Http\Controllers;

use App\Models\AuditReviews;
use App\Models\Division;
use App\Models\User;
use App\Models\Policies;
use App\Models\Evidences;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class EvidencesController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $divisionId = $user->division_id;
        $divisionName = Division::where('division_id', $divisionId)->value('Nama_Divisi'); 
        $evidences = Evidences::all();
        return view('staff.evidences.index', compact('evidences', 'divisionName'));
    }

    public function show($id)
    {
        $evidence = Evidences::findOrFail($id);
        return response()->json($evidence);
    }

    public function store(Request $request)
    {
        $user = request()->user();
        $divisionId = $user->division_id;
        $data = $request->validate([
            'compliance_id' => 'required|integer',
            'file_path' => 'required|string',
        ]);
        $evidence = Evidences::create($data,
        fn ($query) => $query->where('division_id', $divisionId)
        );
        return view('staff.evidences.index', compact('evidences'));
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
