<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_dept',
    ];

    // Relasi dengan tabel User
    public function users()
    {
        return $this->hasMany(User::class, 'id_dept');
    }
}
