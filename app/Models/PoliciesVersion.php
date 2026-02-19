<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliciesVersion extends Model
{
    protected $table = 'policies_versions';

    protected $primaryKey = 'version_id';

    protected $fillable = [
        'policies_id',
        'version_number',
        'document_path',
        'effective_date'
    ];

    protected $casts = [
        'effective_date'=> 'date',
    ];

    public function policies()
    {
        return $this->belongsTo(Policies::class, 'policies_id');
    }

    public function checklists()
    {
        return $this->hasMany(Checklists::class, 'version_id');
    }
}
