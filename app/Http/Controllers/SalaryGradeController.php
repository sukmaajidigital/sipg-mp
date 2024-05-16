<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\SalaryGrade;
use App\Models\SalaryYear;
use App\Models\SalaryMonth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalaryGradeController extends Controller
{
    /** 
     * Display a listing of the resource. 
     */
    public function index()
    {
        $title = 'Salary Per Grade';
        // $salary_grades = SalaryGrade::all();
        $query = SalaryGrade::with('grade');

        // Check if the "Show All" option is selected
        if (request('filter_year') === 'all') {
            // Do not filter by year
        } else {
            // Filter by the selected year
            $filterYear = request('filter_year', Carbon::now()->year);
            $query->where('year', $filterYear);
        }
        $selectedYear = $filterYear ?? null;
        $salary_grades = $query->get();
        $years = SalaryGrade::distinct('year')->pluck('year')->toArray();
        return view('salary_grade.index', compact('title', 'salary_grades', 'years', 'selectedYear'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Salary Per Grade';
        $grades = Grade::all();
        $currentYear = date('Y'); //menetapkan tahun sekarang
        // $currentYear = 2021;
        $existingData = SalaryGrade::where('year', $currentYear)->count();
        return view('salary_grade.create', compact('title', 'grades', 'currentYear', 'existingData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentYear = date('Y'); //menetapkan tahun sekarang
        // $currentYear = 2021;

        // Loop melalui data yang dikirim dari form
        foreach ($request->input('rate_salary') as $gradeId => $rate) {
            // Cek apakah data untuk tahun ini dan grade tersebut sudah ada atau belum
            $existingData = SalaryGrade::where('year', $currentYear)
                ->where('id_grade', $gradeId)
                ->count();

            // Jika belum ada, simpan data
            if ($existingData == 0) {
                SalaryGrade::create([
                    'id_grade' => $gradeId,
                    'rate_salary' => $rate,
                    'year' => $currentYear,
                ]);
            }
        }

        // Redirect atau lakukan aksi lainnya setelah penyimpanan selesai
        return redirect()->route('salarygrade.index')->with('success', 'Data gaji berhasil disimpan.');
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
            return redirect()->route('salarygrade.index')->with('error', 'No data selected for editing.');
        }

        $title = 'Salary Per Grade';
        $grades = Grade::all();
        $salary_grades = SalaryGrade::whereIn('id', $selectedIds)->get();
        $currentYear = date('Y');

        return view('salary_grade.edit', compact('title', 'grades', 'salary_grades', 'currentYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        foreach ($request->input('ids') as $id) {
            $gradeId = $request->input('grade_ids.' . $id);
            $rate = $request->input('rate_salary.' . $id);

            // Perbarui data di tabel salary_grades
            SalaryGrade::where('id', $id)->update([
                'id_grade' => $gradeId,
                'rate_salary' => $rate,
                // Tambahkan kolom lainnya jika ada
            ]);

            // mengambil data salary year untuk melakukan beberapa perubahan hitungan
            $salary_years = SalaryYear::where('id_salary_grade', $id)->get();
            foreach ($salary_years as $salary_year) {
                $ability = $salary_year->ability;
                $fungtional_alw = $salary_year->fungtional_alw;
                $family_alw = $salary_year->family_alw;
                $transport_alw = $salary_year->transport_alw;
                $adjustment = $salary_year->adjustment;

                $total = $rate +  $ability + $fungtional_alw + $family_alw;

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

                SalaryYear::where('id_salary_grade', $id)->update([
                    'bpjs' => $bpjs,
                    'jamsostek' => $jamsostek,
                    'total_ben' => $total_jamsostek,
                    'total_ben_ded' => $total_jamsostek,
                ]);

                $id_salary_year = $salary_year->id;
                $salary_months = SalaryMonth::where('id_salary_year', $id_salary_year)->get();
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
                    $total_overtime = (($rate + $ability) / 173) * $hour_call;

                    // Hitungan untuk mencari totalan
                    $gross_sal = $rate + $ability + $fungtional_alw + $family_alw + $transport_alw +
                        $adjustment + $total_overtime + $thr + $bonus + $incentive;
                    $total_deduction = $bpjs + $jamsostek + $union + $absent + $electricity + $cooperative;
                    $net_salary = ($gross_sal + $total_jamsostek) - ($total_deduction + $total_jamsostek);

                    SalaryMonth::where('id_salary_year', $id_salary_year)->update([
                        'total_overtime' => $total_overtime,
                        'gross_salary' => $gross_sal,
                        'total_deduction' => $total_deduction,
                        'net_salary' => $net_salary,
                    ]);
                }
            }
        }

        // Redirect atau lakukan aksi lainnya setelah pembaruan selesai
        return redirect()->route('salarygrade.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    // public function update(Request $request)
    // {
    //     $value = $request->input('id_salary_grade');
    //     dd($value);
    //     foreach ($request->input('ids') as $key => $value) {
    //         // Simpan nilai input dalam variabel
    //         $input = $request->only([
    //             'rate_salary',
    //         ]);

    //         // Lakukan pembaruan data berdasarkan ID dan grade ID
    //         SalaryGrade::where('id', $value)
    //             ->update(['rate_salary' => $input['rate_salary'][$key]]);
    //     }


    //     // // Ambil data dari form
    //     // $ids = $request->input('ids', []);
    //     // $rateSalaries = $request->input('rate_salary', []);

    //     // // Loop melalui data yang diambil
    //     // foreach ($ids as $key => $id) {
    //     //     $salary_years = SalaryYear::where('id', $id)->update();
    //     //     dd($salary_years);
    //     //     foreach ($salary_years as $salary_year) {

    //     //     }
    //     //     // Perbarui data sesuai dengan ID
    //     //     SalaryGrade::where('id', $id)->update([
    //     //         'rate_salary' => $rateSalaries[$key],
    //     //         // Tambahkan kolom lainnya sesuai kebutuhan
    //     //     ]);
    //     // }

    //     // Redirect atau lakukan aksi lainnya setelah pembaruan selesai
    //     return redirect()->route('salarygrade.index')->with('success', 'Data gaji berhasil diperbarui.');
    // }
}
