<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_job',
    ];

    // Relasi dengan tabel User
    public function users()
    {
        return $this->hasMany(User::class, 'id_job');
    }
}
