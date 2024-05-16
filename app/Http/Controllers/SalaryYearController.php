<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use App\Models\SalaryYear;
use App\Models\SalaryMonth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalaryYearController extends Controller
{
    /** 
     * Display a listing of the resource. 
     */
    public function index()
    {
        $title = 'Salary Per Year';

        // Get the range of years from the salary_years table
        $years = SalaryYear::distinct('year')->pluck('year')->toArray();
        // Get distinct status names through the relationships
        $statuses = Status::distinct('name_status')->pluck('name_status')->toArray();

        // Menyimpan query builder dalam variabel query
        $query = SalaryYear::with('salary_grade');

        // set variabel default null
        $selectedYear = null;
        $selectedStatus = null;

        // percabangan untuk filter status
        if (request('filter_status') != null) {
            if (request('filter_status') != 'all') {
                // Filter by the selected year
                $selectedStatus = request('filter_status');
                $query->whereHas('user.status', function ($subquery) use ($selectedStatus) {
                    $subquery->where('name_status', $selectedStatus);
                });
            }
        }

        // percabangan untuk filter tahun
        if (request('filter_year') != null) {
            if (request('filter_year') != 'all') {
                // Filter by the selected year
                $selectedYear = request('filter_year');
                $query->where('year', $selectedYear);
            }
        } else {
            // untuk menetapkan tahun sekarang saat membuka halaman
            $selectedYear = request('filter_year', Carbon::now()->year);
            $query->where('year', $selectedYear);
        }

        // Query the salary_years based on the selected year and status
        $salary_years = $query->get();
        return view('salary_year.index', compact('title', 'salary_years', 'years', 'statuses', 'selectedYear', 'selectedStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Salary Per Year';
        $statuses = Status::all();
        $currentYear = date('Y'); //menetapkan tahun sekarang

        // Mendapatkan ID status yang diizinkan
        $allowedStatusNames = ['Assistant trainee', 'Manager', 'Monthly', 'Staff'];
        $selectedStatus = request()->input('id_status');

        // Jika filter status dipilih, ambil ID status yang dipilih
        $selectedStatusIds = $selectedStatus
            ? Status::whereIn('name_status', $allowedStatusNames)->where('id', $selectedStatus)->pluck('id')
            : Status::whereIn('name_status', $allowedStatusNames)->pluck('id');

        // Menggunakan eager loading untuk memuat relasi grade dan salary_grades
        $users = User::with(['grade.salary_grades' => function ($query) {
            $query->orderBy('year', 'desc'); // Jika Anda ingin mengurutkan berdasarkan tahun.
        }])->whereIn('id_status', $selectedStatusIds)->get();

        // Filter users yang telah memiliki data gaji untuk tahun ini
        $users = $users->filter(function ($user) {
            return !$user->hasSalaryForYear(date('Y'));
        });

        // Meneruskan data ke tampilan
        return view('salary_year.create', compact('title', 'users', 'statuses', 'selectedStatus'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lakukan iterasi pada data yang dikirimkan melalui form
        foreach ($request->input('id_user') as $key => $value) {

            // Simpan nilai input dalam variabel
            $input = $request->only([
                'id_user', 'id_salary_grade', 'rate_salary',
                'ability', 'fungtional_alw', 'family_alw',
                'transport_alw', 'adjustment'
            ]);

            $ability = $input['ability'][$key] ?? 0;
            $fungtional_alw = $input['fungtional_alw'][$key]  ?? 0;
            $family_alw = $input['family_alw'][$key]  ?? 0;
            $transport_alw = $input['transport_alw'][$key]  ?? 0;
            $adjustment = $input['adjustment'][$key]  ?? 0;

            $total = $input['rate_salary'][$key] +  $ability + $fungtional_alw + $family_alw;

            // untuk kolom deduction
            if ($total > 12000000) {
                $bpjs = 12000000 * 0.01;
            } else {
                $bpjs = $total * 0.01;
            }
            $jamsostek = $total * 0.02;

            // untuk menghitung data benefit
            $jamsostek_jkk = $total * 0.0054;
            $jamsostek_tk = $total * 0.003;
            $jamsostek_tht = $total * 0.037;
            $total_jamsostek = $jamsostek_jkk + $jamsostek_tk + $jamsostek_tht;

            // Simpan data ke dalam database
            SalaryYear::create([
                'id_user' => $input['id_user'][$key], // Pastikan Anda memiliki input user_id pada form
                'id_salary_grade' => $input['id_salary_grade'][$key], // Pastikan Anda memiliki input salary_grade_id pada form
                'year' => date('Y'),
                'ability' => $ability,
                'fungtional_alw' => $fungtional_alw,
                'family_alw' => $family_alw,
                'transport_alw' => $transport_alw,
                'adjustment' => $adjustment,
                'bpjs' => $bpjs,
                'jamsostek' => $jamsostek,
                'total_ben' => $total_jamsostek,
                'total_ben_ded' => $total_jamsostek,
            ]);
        }

        // Redirect atau lakukan sesuatu setelah penyimpanan berhasil
        return redirect()->route('salary-year.index')->with('success', 'Data gaji berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $selectedIds = $request->input('ids', []);

        // Konversi string parameter ke dalam bentuk array
        if (is_string($selectedIds)) {
            $selectedIds = explode(',', $selectedIds);
        }

        // Jika tidak ada id yang dipilih, redirect kembali atau tampilkan pesan sesuai kebutuhan
        if (empty($selectedIds)) {
            return redirect()->route('salary-year.index')->with('error', 'No data selected for editing.');
        }

        $title = 'Salary Per Grade';
        $salary_years = SalaryYear::whereIn('id', $selectedIds)->get();
        $currentYear = date('Y');

        return view('salary_year.edit', compact('title', 'salary_years'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        foreach ($request->input('ids') as $id) {
            $rate_salary = $request->input('rate_salary.' . $id);
            $ability =  $request->input('ability.' . $id);
            $fungtional_alw =  $request->input('fungtional_alw.' . $id);
            $family_alw =  $request->input('family_alw.' . $id);
            $transport_alw =  $request->input('transport_alw.' . $id);
            $adjustment =  $request->input('adjustment.' . $id);

            $total = $rate_salary +  $ability + $fungtional_alw + $family_alw;

            // untuk kolom deduction
            if ($total > 12000000) {
                $bpjs = 12000000 * 0.01;
            } else {
                $bpjs = $total * 0.01;
            }
            $jamsostek = $total * 0.02;

            // untuk menghitung data benefit
            $jamsostek_jkk = $total * 0.0054;
            $jamsostek_tk = $total * 0.003;
            $jamsostek_tht = $total * 0.037;
            $total_jamsostek = $jamsostek_jkk + $jamsostek_tk + $jamsostek_tht;
            // Perbarui data di tabel salary_grades
            SalaryYear::where('id', $id)->update([
                'ability' => $ability,
                'fungtional_alw' => $fungtional_alw,
                'family_alw' => $family_alw,
                'transport_alw' => $transport_alw,
                'adjustment' => $adjustment,
                'bpjs' => $bpjs,
                'jamsostek' => $jamsostek,
                'total_ben' => $total_jamsostek,
                'total_ben_ded' => $total_jamsostek,
            ]);

            // menggunakan untuk mendapatkan value atribut yang tidak ada di form edit
            $salary_months = SalaryMonth::where('id_salary_year', $id)->get();
            foreach ($salary_months as $salary_month) {
                $thr = $salary_month->thr;
                $bonus = $salary_month->bonus;
                $incentive = $salary_month->incentive;

                $union = $salary_month->union;
                $absent = $salary_month->absent;
                $electricity = $salary_month->electricity;
                $cooperative = $salary_month->cooperative;

                // Hitungan total overtime
                $hour_call = $salary_month->hour_call;
                $total_overtime = (($rate_salary + $ability) / 173) * $hour_call;

                // Hitungan untuk mencari totalan
                $gross_sal = $rate_salary + $ability + $fungtional_alw + $family_alw + $transport_alw +
                    $adjustment + $total_overtime + $thr + $bonus + $incentive;
                $total_deduction = $bpjs + $jamsostek + $union + $absent + $electricity + $cooperative;
                $net_salary = ($gross_sal + $total_jamsostek) - ($total_deduction + $total_jamsostek);

                SalaryMonth::where('id_salary_year', $id)->update([
                    'total_overtime' => $total_overtime,
                    'gross_salary' => $gross_sal,
                    'total_deduction' => $total_deduction,
                    'net_salary' => $net_salary,
                ]);
            }
        }

        // Redirect atau lakukan aksi lainnya setelah pembaruan selesai
        return redirect()->route('salary-year.index')->with('success', 'Data gaji berhasil diperbarui.');
    }
}
