<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'name',
        'id_status',
        'id_grade',
        'id_dept',
        'id_job',
        'sex',
        'ttl',
        'start',
        'pendidikan',
        'agama',
        'domisili',
        'email',
        'no_ktp',
        'no_telpon',
        'kis',
        'kpj',
        'suku',
        'no_sepatu_safety',
        'start_work_user',
        'end_work_user',
        'loc_kerja',
        'loc',
        'sistem_absensi',
        'latitude',
        'longitude',
        'aktual_cuti',
        'status_pernikahan',
        'istri_suami',
        'anak_1',
        'anak_2',
        'anak_3',
        'access_by',
        'image_url',
        'role_app',
        'active',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi dengan tabel Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    // Relasi dengan tabel Grade
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'id_grade');
    }

    // Relasi dengan tabel Department
    public function dept()
    {
        return $this->belongsTo(Dept::class, 'id_dept');
    }

    // Relasi dengan tabel Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'id_job');
    }

    // Relasi dengan tabel Salary
    public function salary_years()
    {
        return $this->hasMany(SalaryYear::class, 'id_user');
    }

    // method mengecek apakah data user sudah berelasi dengan salary_years tahun ini
    public function hasSalaryForYear($year)
    {
        return $this->salary_years()->whereYear('year', $year)->exists();
    }

    // method mengecek apakah data user sudah berelasi dengan salary_years tahun ini
    public function hasSalaryForYearAndMonth($year, $month)
    {
        return $this->salary_years()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->exists();
    }

    public function hasSalaryForMonth($month)
    {
        return $this->salaries()
            ->whereMonth('created_at', $month)
            ->exists();
    }
}
