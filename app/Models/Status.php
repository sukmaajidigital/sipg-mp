<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_status',
    ];

    // Relasi dengan tabel User
    public function users()
    {
        return $this->hasMany(User::class, 'id_status');
    }
}
