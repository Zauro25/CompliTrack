<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidences extends Model
{
    protected $table = 'evidences';

    protected $primaryKey = 'evidence_id';

    protected $fillable = [
        'compliance_id',
        'file_path',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    public function complianceEntry()
    {
        return $this->belongsTo(ComplianceEntries::class, 'compliance_id');
    }
    
}
