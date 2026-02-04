<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
        'division_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function complianceEntries()
    {
        return $this->hasMany(ComplianceEntries::class, 'user_id');
    }
}
