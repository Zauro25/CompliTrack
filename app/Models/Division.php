<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';

    protected $fillable = [
        'Nama_Divisi',
        'Deskripsi',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'division_id');
    }

    public function policies()
    {
        return $this->hasMany(Policies::class, 'division_id');
    }
}
