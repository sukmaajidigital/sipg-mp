<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_grade',
    ];

    // Relasi dengan tabel User
    public function users()
    {
        return $this->hasMany(User::class, 'id_grade');
    }

    // Relasi dengan tabel salaryGrade
    public function salary_grades()
    {
        return $this->hasMany(SalaryGrade::class, 'id_grade');
    }
}
