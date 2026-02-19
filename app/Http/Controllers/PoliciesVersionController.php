<?php

namespace App\Http\Controllers;

use App\Models\Policies;
use App\Models\PoliciesVersion;
use Illuminate\Http\Request;

class PoliciesVersionController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(PoliciesVersion::with('policies')->get());
        }

        $versions = PoliciesVersion::with('policies')->latest()->paginate(10);

        return view('admin.policies_versions.index', compact('versions'));
    }

    public function create()
    {
        $policies = Policies::orderBy('Judul')->get();

        return view('admin.policies_versions.create', compact('policies'));
    }

    public function show(Request $request, $id)
    {
        $version = PoliciesVersion::with('policies')->findOrFail($id);

        if (!$this->isApi($request)) {
            return view('admin.policies_versions.show', compact('version'));
        }

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

        if (!$this->isApi($request)) {
            return redirect()->route('admin.policies-versions.index')->with('success', 'Policy version created successfully.');
        }

        return response()->json($version, 201);
    }

    public function edit($id)
    {
        $version = PoliciesVersion::findOrFail($id);
        $policies = Policies::orderBy('Judul')->get();

        return view('admin.policies_versions.edit', compact('version', 'policies'));
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

        if (!$this->isApi($request)) {
            return redirect()->route('admin.policies-versions.index')->with('success', 'Policy version updated successfully.');
        }

        return response()->json($version);
    }

    public function destroy(Request $request, $id)
    {
        $version = PoliciesVersion::findOrFail($id);
        $version->delete();

        if (!$this->isApi($request)) {
            return redirect()->route('admin.policies-versions.index')->with('success', 'Policy version deleted successfully.');
        }

        return response()->json(['message' => 'Deleted successfully']);
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
