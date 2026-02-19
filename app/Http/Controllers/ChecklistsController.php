<?php

namespace App\Http\Controllers;

use App\Models\Checklists;
use App\Models\ComplianceEntries;
use App\Models\PoliciesVersion;
use Illuminate\Http\Request;

class ChecklistsController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(Checklists::with('policiesVersion.policies')->get());
        }

        $user = $request->user();
        $checklists = Checklists::with('policiesVersion.policies')
            ->whereHas(
                'policiesVersion.policies',
                fn ($query) => $query->where('division_id', $user->division_id)
            )
            ->latest()
            ->paginate(10);

        return view('staff.checklists.index', compact('checklists'));
    }

    public function create(Request $request)
    {
        $user = $request->user();

        $versions = PoliciesVersion::with('policies')
            ->whereHas(
                'policies',
                fn ($query) => $query->where('division_id', $user->division_id)
            )
            ->orderByDesc('effective_date')
            ->get();

        return view('staff.checklists.create', compact('versions'));
    }

    public function show(Request $request, $id)
    {
        $checklist = Checklists::with('policiesVersion.policies')->findOrFail($id);

        if (!$this->isApi($request)) {
            return view('staff.checklists.show', compact('checklist'));
        }

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

        if (!$this->isApi($request)) {
            $versionExistsForDivision = PoliciesVersion::where('version_id', $data['version_id'])
                ->whereHas(
                    'policies',
                    fn ($query) => $query->where('division_id', $request->user()->division_id)
                )
                ->exists();

            if (!$versionExistsForDivision) {
                return back()->withErrors([
                    'version_id' => 'Selected policy version is not valid for your division.',
                ])->withInput();
            }
        }

        $checklist = Checklists::create($data);

        if (!$this->isApi($request)) {
            return redirect()->route('staff.checklists.index')->with('success', 'Checklist created successfully.');
        }

        return response()->json($checklist, 201);
    }

    public function edit($id)
    {
        $checklist = Checklists::with('policiesVersion.policies')->findOrFail($id);

        return view('staff.checklists.edit', compact('checklist'));
    }

    public function update(Request $request, $id)
    {
        $checklist = Checklists::findOrFail($id);

        if (!$this->isApi($request)) {
            $entry = ComplianceEntries::firstOrCreate(
                [
                    'checklist_id' => $checklist->checklist_id,
                    'user_id' => $request->user()->user_id,
                ],
                [
                    'status' => 'pending',
                ]
            );

            $entry->update([
                'status' => $request->validate([
                    'status' => 'required|in:compliant,non_compliant,pending',
                    'note' => 'nullable|string',
                ])['status'],
                'note' => $request->input('note'),
                'checked_at' => now(),
            ]);

            return redirect()->route('staff.checklists.index')->with('success', 'Checklist updated successfully.');
        }

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

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
