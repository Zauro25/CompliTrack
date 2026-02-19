<?php

namespace Tests\Feature;

use App\Models\AuditReviews;
use App\Models\Checklists;
use App\Models\ComplianceEntries;
use App\Models\Division;
use App\Models\Evidences;
use App\Models\Policies;
use App\Models\PoliciesVersion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuditorReviewWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_auditor_can_view_compliance_detail_with_evidences(): void
    {
        [$auditor, $entry, $evidence] = $this->createAuditorFlowData();

        $response = $this->actingAs($auditor)
            ->get(route('auditor.compliance-entries.show', $entry->compliance_id));

        $response->assertOk();
        $response->assertSee('Evidences');
        $response->assertSee('View File');
        $response->assertSee(route('auditor.evidences.file', $evidence->evidence_id, false));
    }

    public function test_auditor_can_open_evidence_file(): void
    {
        [$auditor, $entry, $evidence] = $this->createAuditorFlowData();

        $response = $this->actingAs($auditor)
            ->get(route('auditor.evidences.file', $evidence->evidence_id));

        $response->assertOk();
        $response->assertHeader('content-disposition', 'inline; filename="auditor-proof.txt"');
    }

    public function test_auditor_can_create_and_update_review_without_duplicate(): void
    {
        [$auditor, $entry] = $this->createAuditorFlowData();

        $this->actingAs($auditor)
            ->post(route('auditor.audit-reviews.store'), [
                'compliance_id' => $entry->compliance_id,
                'status' => 'needs_fix',
                'notes' => 'Initial finding',
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('audit_reviews', [
            'compliance_id' => $entry->compliance_id,
            'auditor_id' => $auditor->user_id,
            'status' => 'needs_fix',
            'notes' => 'Initial finding',
        ]);

        $this->actingAs($auditor)
            ->post(route('auditor.audit-reviews.store'), [
                'compliance_id' => $entry->compliance_id,
                'status' => 'approved',
                'notes' => 'All fixed',
            ])
            ->assertSessionHasNoErrors();

        $this->assertSame(
            1,
            AuditReviews::where('compliance_id', $entry->compliance_id)
                ->where('auditor_id', $auditor->user_id)
                ->count()
        );

        $this->assertDatabaseHas('audit_reviews', [
            'compliance_id' => $entry->compliance_id,
            'auditor_id' => $auditor->user_id,
            'status' => 'approved',
            'notes' => 'All fixed',
        ]);
    }

    /**
     * @return array{0: User, 1: ComplianceEntries, 2: Evidences}
     */
    private function createAuditorFlowData(): array
    {
        Storage::fake('public');

        $staffDivision = Division::create([
            'Nama_Divisi' => 'Operations',
            'Deskripsi' => 'Operations Division',
        ]);

        $auditorDivision = Division::create([
            'Nama_Divisi' => 'Internal Audit',
            'Deskripsi' => 'Audit Division',
        ]);

        $staff = User::factory()->create([
            'role' => 'staff',
            'division_id' => $staffDivision->division_id,
        ]);

        $auditor = User::factory()->create([
            'role' => 'auditor',
            'division_id' => $auditorDivision->division_id,
        ]);

        $policy = Policies::create([
            'division_id' => $staffDivision->division_id,
            'Judul' => 'Data Handling Policy',
            'Deskripsi' => 'Policy for data handling',
            'Status' => 'active',
        ]);

        $version = PoliciesVersion::create([
            'policies_id' => $policy->policies_id,
            'version_number' => '1.0',
            'document_path' => 'policies/data-handling-v1.pdf',
            'effective_date' => now()->toDateString(),
        ]);

        $checklist = Checklists::create([
            'version_id' => $version->version_id,
            'Judul_Checklist' => 'Encrypt sensitive data',
            'Deskripsi' => 'Ensure sensitive data encryption at rest',
            'required' => true,
        ]);

        $entry = ComplianceEntries::create([
            'checklist_id' => $checklist->checklist_id,
            'user_id' => $staff->user_id,
            'status' => 'pending',
            'note' => 'Waiting for audit review',
            'checked_at' => now(),
        ]);

        Storage::disk('public')->put('evidences/auditor-proof.txt', 'proof-content');

        $evidence = Evidences::create([
            'compliance_id' => $entry->compliance_id,
            'file_path' => 'evidences/auditor-proof.txt',
        ]);

        return [$auditor, $entry, $evidence];
    }
}
