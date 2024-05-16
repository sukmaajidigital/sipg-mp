<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_grade',
        'rate_salary',
        'year',
    ];

    // Relasi dengan tabel Grade
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'id_grade');
    }

    public function salary_years()
    {
        return $this->hasMany(Salary::class, 'id_salary_grade');
    }
}
