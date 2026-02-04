<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditReviews extends Model
{
    protected $table = 'audit_reviews';

    protected $primaryKey = 'audit_review_id';

    protected $fillable = [
        'compliance_id',
        'auditor_id',
        'status',
        'notes',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function complianceEntry()
    {
        return $this->belongsTo(ComplianceEntries::class, 'compliance_id');
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }
}
