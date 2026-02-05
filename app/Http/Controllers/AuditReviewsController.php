<?php

namespace App\Http\Controllers;

use App\Models\AuditReviews;
use Illuminate\Http\Request;

class AuditReviewsController extends Controller
{
    public function index()
    {
        $reviews = AuditReviews::all();
        return response()->json($reviews);
    }

    public function show($id)
    {
        $review = AuditReviews::findOrFail($id);
        return response()->json($review);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'compliance_id' => 'required|integer',
            'auditor_id' => 'required|integer',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        $review = AuditReviews::create($data);
        return response()->json($review, 201);
    }

    public function update(Request $request, $id)
    {
        $review = AuditReviews::findOrFail($id);
        $data = $request->validate([
            'compliance_id' => 'sometimes|integer',
            'auditor_id' => 'sometimes|integer',
            'status' => 'sometimes|string',
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
}
