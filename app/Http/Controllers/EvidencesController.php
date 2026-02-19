<?php

namespace App\Http\Controllers;

use App\Models\ComplianceEntries;
use App\Models\Evidences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EvidencesController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(Evidences::with('complianceEntry')->get());
        }

        $user = $request->user();
        $evidences = Evidences::with('complianceEntry.checklist.policiesVersion.policies')
            ->whereHas(
                'complianceEntry.checklist.policiesVersion.policies',
                fn ($query) => $query->where('division_id', $user->division_id)
            )
            ->latest()
            ->paginate(10);

        return view('staff.evidences.index', compact('evidences'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $entries = ComplianceEntries::with('checklist')
            ->where('user_id', $user->user_id)
            ->orderByDesc('updated_at')
            ->get();

        return view('staff.evidences.create', compact('entries'));
    }

    public function show(Request $request, $id)
    {
        $evidence = Evidences::findOrFail($id);

        if (!$this->isApi($request)) {
            return redirect()->route('staff.evidences.index');
        }

        return response()->json($evidence);
    }

    public function viewFile(Request $request, $id)
    {
        $user = $request->user();

        $query = Evidences::with('complianceEntry.checklist.policiesVersion.policies')
            ->where('evidence_id', $id);

        if ($user?->role === 'staff') {
            $query->whereHas(
                'complianceEntry.checklist.policiesVersion.policies',
                fn ($builder) => $builder->where('division_id', $user->division_id)
            );
        }

        $evidence = $query->firstOrFail();

        if (!Storage::disk('public')->exists($evidence->file_path)) {
            abort(404, 'File not found.');
        }

        $filename = basename($evidence->file_path);
        $absolutePath = Storage::disk('public')->path($evidence->file_path);

        return response()->file($absolutePath, [
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'compliance_id' => 'required|integer',
            'file' => 'required|file|max:5120',
        ]);

        $filePath = $request->file('file')->store('evidences', 'public');

        Evidences::create([
            'compliance_id' => $validated['compliance_id'],
            'file_path' => $filePath,
        ]);

        if ($this->isApi($request)) {
            return response()->json(['message' => 'Evidence uploaded successfully.'], 201);
        }

        return redirect()->route('staff.evidences.index')->with('success', 'Evidence uploaded successfully.');
    }

    public function update(Request $request, $id)
    {
        $evidence = Evidences::findOrFail($id);

        $validated = $request->validate([
            'compliance_id' => 'sometimes|integer',
            'file' => 'nullable|file|max:5120',
        ]);

        if ($request->hasFile('file')) {
            if ($evidence->file_path) {
                Storage::disk('public')->delete($evidence->file_path);
            }

            $validated['file_path'] = $request->file('file')->store('evidences', 'public');
        }

        unset($validated['file']);
        $evidence->update($validated);

        return response()->json($evidence);
    }

    public function destroy(Request $request, $id)
    {
        $evidence = Evidences::findOrFail($id);

        if ($evidence->file_path) {
            Storage::disk('public')->delete($evidence->file_path);
        }

        $evidence->delete();

        if ($this->isApi($request)) {
        return response()->json(['message' => 'Deleted successfully']);
        }

        return redirect()->route('staff.evidences.index')->with('success', 'Evidence deleted successfully.');
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
