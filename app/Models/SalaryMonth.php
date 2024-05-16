<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryMonth extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_salary_year',
        'date',
        'hour_call',
        'total_overtime',
        'thr',
        'bonus',
        'incentive',
        'union',
        'absent',
        'electricity',
        'cooperative',
        'gross_salary',
        'total_deduction',
        'net_salary',
        'allocation',
        'is_checked',
        'is_approved',
    ];

    // Relasi dengan tabel User
    public function salary_year()
    {
        return $this->belongsTo(SalaryYear::class, 'id_salary_year');
    }
}
