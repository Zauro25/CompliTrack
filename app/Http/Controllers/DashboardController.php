<?php

namespace App\Http\Controllers;

use App\Models\AuditReviews;
use App\Models\Division;
use App\Models\User;
use App\Models\Policies;
use App\Models\Evidences;
use App\Models\Checklists;
use App\Models\ComplianceEntries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $role = $user?->role ?? null;
        if(!$user) {
            abort(401, 'unauthorized');
        }
        if(!$role){
            abort(403, 'forbidden');
        }
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            'auditor' => redirect()->route('auditor.dashboard'),
            default => abort(403, 'forbidden'),
        };
    }

    public function adminDashboard()
    {
        $totalUser = User::count();
        $totalDivision = Division::count();
        $totalPolicies = Policies::count();
        $totalEvidences = Evidences::count();
        
        return view('admin.dashboard', compact(
            'totalUser',
            'totalDivision',
            'totalPolicies',
            'totalEvidences'
        ));
    }

    public function staffDashboard()
    {
        $user = request()->user();
        $divisionId = $user->division_id;
        $divisionName = Division::where('division_id', $divisionId)->value('Nama_Divisi'); 
        $totalPolicies = Policies::where('division_id', $divisionId)->count();
        // $totalChecklist = Checklists::where('division_id', $divisionId)->count();

        $totalCompliance = ComplianceEntries::whereHas( 'checklist.policiesVersion.policies',
        fn ($query) => $query->where('division_id', $divisionId)
        )->count();

        $totalEvidences = Evidences::whereHas(
        'complianceEntry.checklist.policiesVersion.policies',
        fn ($query) => $query->where('division_id', $divisionId)
        )->count();

        return view('staff.dashboard', compact(
            'divisionId',
            'divisionName',
            'totalPolicies',
            // 'totalChecklist',
            'totalEvidences',
        ));
    }

    public function auditorDashboard($user)
    {
        $totalAuditReviews = AuditReviews::count();
        $pendingReviews = AuditReviews::where('status', 'pending')->count();

        return view ('auditor.dashboard', compact(
            'totalAuditReviews',
            'pendingReviews'
        ),
        response()->json($totalAuditReviews, $pendingReviews));
    }
}
