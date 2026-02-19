<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    use TwoFactorAuthenticatable;
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'Nama',
        'email',
        'username',
        'password',
        'division_id',
        'role',
    ];

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    public function getNameAttribute(): ?string
    {
        return $this->attributes['Nama'] ?? null;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['Nama'] = $value;
    }

    public function getIdAttribute(): ?int
    {
        return $this->attributes['user_id'] ?? null;
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function complianceEntries()
    {
        return $this->hasMany(ComplianceEntries::class, 'user_id');
    }
}
