<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
        'division_id',
        'role',
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
