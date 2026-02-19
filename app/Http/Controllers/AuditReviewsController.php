<?php

namespace App\Http\Controllers;

use App\Models\AuditReviews;
use App\Models\ComplianceEntries;
use Illuminate\Http\Request;

class AuditReviewsController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(AuditReviews::with(['complianceEntry', 'auditor'])->get());
        }

        $reviews = AuditReviews::with(['complianceEntry.user', 'auditor'])->latest()->paginate(10);

        return view('auditor.audit_reviews.index', compact('reviews'));
    }

    public function show(Request $request, $id)
    {
        $review = AuditReviews::with(['complianceEntry.checklist', 'auditor'])->findOrFail($id);

        if (!$this->isApi($request)) {
            return view('auditor.audit_reviews.show', compact('review'));
        }

        return response()->json($review);
    }

    public function store(Request $request)
    {
        if (!$this->isApi($request)) {
            $data = $request->validate([
                'compliance_id' => 'required|integer|exists:compliance_entries,compliance_id',
                'status' => 'required|in:approved,needs_fix',
                'notes' => 'nullable|string',
            ]);

            ComplianceEntries::findOrFail($data['compliance_id']);

            $review = AuditReviews::updateOrCreate(
                [
                    'compliance_id' => $data['compliance_id'],
                    'auditor_id' => $request->user()->user_id,
                ],
                [
                    'status' => $data['status'],
                    'notes' => $data['notes'] ?? null,
                    'reviewed_at' => now(),
                ]
            );

            return redirect()->route('auditor.audit-reviews.show', $review->audit_review_id)->with('success', 'Audit review saved successfully.');
        }

        $data = $request->validate([
            'compliance_id' => 'required|integer',
            'auditor_id' => 'required|integer',
            'status' => 'required|in:approved,needs_fix',
            'notes' => 'nullable|string',
        ]);

        $review = AuditReviews::create($data);

        return response()->json($review, 201);
    }

    public function update(Request $request, $id)
    {
        $review = AuditReviews::findOrFail($id);

        if (!$this->isApi($request)) {
            $data = $request->validate([
                'status' => 'required|in:approved,needs_fix',
                'notes' => 'nullable|string',
            ]);

            $review->update([
                'status' => $data['status'],
                'notes' => $data['notes'] ?? null,
                'reviewed_at' => now(),
            ]);

            return redirect()->route('auditor.audit-reviews.show', $review->audit_review_id)->with('success', 'Audit review updated successfully.');
        }

        $data = $request->validate([
            'compliance_id' => 'sometimes|integer',
            'auditor_id' => 'sometimes|integer',
            'status' => 'sometimes|in:approved,needs_fix',
            'notes' => 'nullable|string',
        ]);
        $review->update($data);

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = AuditReviews::findOrFail($id);
        $review->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
