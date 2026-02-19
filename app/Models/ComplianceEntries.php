<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceEntries extends Model
{
    protected $table = 'compliance_entries';

    protected $primaryKey = 'compliance_id';

    protected $fillable = [
        'checklist_id',
        'user_id',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => 'string',
        'checked_at' => 'datetime',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklists::class, 'checklist_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evidences()
    {
        return $this->hasMany(Evidences::class, 'compliance_id');
    }

    public function auditReviews()
    {
        return $this->hasMany(AuditReviews::class, 'compliance_id');
    }

    public function latestAuditReview()
    {
        return $this->hasOne(AuditReviews::class, 'compliance_id')->latestOfMany('reviewed_at');
    }


}
