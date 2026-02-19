<?php

namespace App\Http\Controllers;

use App\Models\Checklists;
use App\Models\AuditReviews;
use App\Models\ComplianceEntries;
use Illuminate\Http\Request;

class ComplianceEntriesController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(ComplianceEntries::with(['checklist', 'user'])->get());
        }

        $user = $request->user();
        if ($user?->role === 'auditor') {
            $entries = ComplianceEntries::with(['checklist.policiesVersion.policies', 'user'])
                ->latest()
                ->paginate(10);

            return view('auditor.compliance_entries.index', compact('entries'));
        }

        $entries = ComplianceEntries::with(['checklist.policiesVersion.policies', 'user'])
            ->where('user_id', $user->user_id)
            ->with('latestAuditReview.auditor')
            ->latest()
            ->paginate(10);

        return view('staff.compliance_entries.index', compact('entries'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $checklists = Checklists::with('policiesVersion.policies')
            ->whereHas(
                'policiesVersion.policies',
                fn ($query) => $query->where('division_id', $user->division_id)
            )
            ->orderBy('Judul_Checklist')
            ->get();

        return view('staff.compliance_entries.create', compact('checklists'));
    }

    public function show(Request $request, $id)
    {
        $entry = ComplianceEntries::with(['checklist.policiesVersion.policies', 'user', 'evidences', 'latestAuditReview.auditor'])->findOrFail($id);

        if (!$this->isApi($request)) {
            if ($request->user()?->role === 'auditor') {
                $existingReview = AuditReviews::where('compliance_id', $entry->compliance_id)
                    ->where('auditor_id', $request->user()->user_id)
                    ->first();

                return view('auditor.compliance_entries.show', compact('entry', 'existingReview'));
            }

            return view('staff.compliance_entries.show', compact('entry'));
        }

        return response()->json($entry);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'checklist_id' => 'required|integer',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $entry = ComplianceEntries::create([
            'checklist_id' => $validated['checklist_id'],
            'user_id' => $this->isApi($request) ? $request->validate(['user_id' => 'required|integer'])['user_id'] : $request->user()->user_id,
            'status' => $validated['status'],
            'note' => $validated['note'] ?? null,
            'checked_at' => now(),
        ]);

        if (!$this->isApi($request)) {
            return redirect()->route('staff.compliance-entries.index')->with('success', 'Compliance entry created successfully.');
        }

        return response()->json($entry, 201);
    }

    public function update(Request $request, $id)
    {
        $entry = ComplianceEntries::findOrFail($id);

        if (!$this->isApi($request)) {
            $data = $request->validate([
                'status' => 'required|in:compliant,non_compliant,pending',
                'note' => 'nullable|string',
            ]);

            $entry->update([
                'status' => $data['status'],
                'note' => $data['note'] ?? null,
                'checked_at' => now(),
            ]);

            return redirect()->route('auditor.compliance-entries.show', $entry->compliance_id)->with('success', 'Compliance entry updated successfully.');
        }

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

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
