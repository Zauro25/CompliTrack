<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Policies;
use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isApi($request)) {
            return response()->json(Policies::with('division')->get());
        }

        $user = $request->user();

        if ($user?->role === 'staff') {
            $policies = Policies::with('division')
                ->where('division_id', $user->division_id)
                ->latest()
                ->paginate(10);

            return view('staff.policies.index', compact('policies'));
        }

        $policies = Policies::with('division')->latest()->paginate(10);

        return view('admin.policies.index', compact('policies'));
    }

    public function create()
    {
        $divisions = Division::orderBy('Nama_Divisi')->get();

        return view('admin.policies.create', compact('divisions'));
    }

    public function show(Request $request, $id)
    {
        $policy = Policies::with('division')->findOrFail($id);

        if (!$this->isApi($request)) {
            return view('admin.policies.show', compact('policy'));
        }

        return response()->json($policy);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'division_id' => 'required|integer',
            'Judul' => 'required|string',
            'Deskripsi' => 'nullable|string',
            'Status' => 'required|in:draft,active,archived',
        ]);
        $policy = Policies::create($data);

        if (!$this->isApi($request)) {
            return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully.');
        }

        return response()->json($policy, 201);
    }

    public function edit($id)
    {
        $policy = Policies::findOrFail($id);
        $divisions = Division::orderBy('Nama_Divisi')->get();

        return view('admin.policies.edit', compact('policy', 'divisions'));
    }

    public function update(Request $request, $id)
    {
        $policy = Policies::findOrFail($id);
        $data = $request->validate([
            'division_id' => 'sometimes|integer',
            'Judul' => 'sometimes|string',
            'Deskripsi' => 'nullable|string',
            'Status' => 'sometimes|in:draft,active,archived',
        ]);
        $policy->update($data);

        if (!$this->isApi($request)) {
            return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully.');
        }

        return response()->json($policy);
    }

    public function destroy(Request $request, $id)
    {
        $policy = Policies::findOrFail($id);
        $policy->delete();

        if (!$this->isApi($request)) {
            return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully.');
        }

        return response()->json(['message' => 'Deleted successfully']);
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
