<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_salary_grade',
        'year',
        'ability',
        'fungtional_alw',
        'family_alw',
        'transport_alw',
        'adjustment',
        'bpjs',
        'jamsostek',
        'total_ben',
        'total_ben_ded',
    ];

    // Relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan tabel SalaryGrade
    public function salary_grade()
    {
        return $this->belongsTo(SalaryGrade::class, 'id_salary_grade');
    }

    // Relasi dengan tabel Salary
    public function salary_months()
    {
        return $this->hasMany(SalaryMonth::class, 'id_salary_year');
    }

    // method mengecek apakah data user sudah berelasi dengan salary_years tahun ini
    public function hasSalaryForMonth($year, $month)
    {
        return $this->salary_months()->whereYear('date', $year)->whereMonth('date', $month)->exists();
    }
}
