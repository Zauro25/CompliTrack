<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklists extends Model
{
    protected $table = 'checklists';

    protected $primaryKey = 'checklist_id';

    protected $fillable = [
        'version_id',
        'Judul_Checklist',
        'Deskripsi',
        'required',
    ];

    protected $casts = [
        'required' => 'boolean',
    ];

    public function policiesVersion()
    {
        return $this->belongsTo(PoliciesVersion::class, 'version_id');
    }

    public function complianceEntries()
    {
        return $this->hasMany(ComplianceEntries::class, 'checklist_id');
    }
}
