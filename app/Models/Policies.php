<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    protected $table = 'policies';

    protected $primaryKey = 'policies_id';

    protected $fillable = [
        'division_id',
        'Judul',
        'Deskripsi',
        'Status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function policiesVersions()
    {
        return $this->hasMany(PoliciesVersion::class, 'policies_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
