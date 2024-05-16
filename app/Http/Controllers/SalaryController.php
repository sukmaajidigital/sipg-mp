<?php

namespace App\Http\Controllers;

use App\Models\SalaryMonth;
use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class SalaryController extends Controller
{
    /** 
     * Display a listing of the resource. 
     */
    public function index()
    {
        $title = 'Salary';
        $salary_months = SalaryMonth::all();

        // $monthOpts = SalaryMonth::select(DB::raw('MONTH(date) as month'))
        //     ->distinct()
        //     ->pluck('month');

        // $yearOpts = SalaryMonth::select(DB::raw('YEAR(date) as year'))
        //     ->distinct()
        //     ->pluck('year');
        // Get the range of years and months from the salary_months table
        $years = SalaryMonth::distinct('date')->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y');
        })->unique()->toArray();
        $months = SalaryMonth::distinct('date')->pluck('date')->map(function ($date) {
            $carbonDate = Carbon::parse($date);
            // format keluaran yang berbeda menggunakan array
            return [
                'value' => $carbonDate->format('m'), // Nilai bulan dalam format numerik
                'label' => $carbonDate->format('F'), // Nama bulan dalam format teks
            ];
        })->unique()->toArray();

        // Get distinct status names through the relationships
        $statuses = Status::distinct('name_status')->pluck('name_status')->toArray();

        // Menyimpan query builder dalam variabel query
        $query = SalaryMonth::with('salary_year');

        // Set the default selected year to the current year
        $selectedYear =  null;
        $selectedMonth = null;
        // $selectedMonth = Carbon::now()->format('F');
        $selectedStatus = null;

        // percabangan untuk filter status
        if (request('filter_status') != null) {
            if (request('filter_status') != 'all') {
                // Filter by the selected status
                $selectedStatus = request('filter_status');
                $query->whereHas('salary_year.user.status', function ($subquery) use ($selectedStatus) {
                    $subquery->where('name_status', $selectedStatus);
                });
            }
        }

        // percabangan untuk filter tahun
        if (request('filter_year') != null) {
            if (request('filter_year') != 'all') {
                // Filter by the selected year
                $selectedYear = request('filter_year');
                $query->whereYear('date', $selectedYear);
            }
        } else {
            // untuk menetapkan tahun sekarang saat membuka halaman
            $selectedYear = request('filter_year', Carbon::now()->year);
            $query->whereYear('date', $selectedYear);
        }

        // percabangan untuk filter bulan
        if (request('filter_month') != null) {
            if (request('filter_month') != 'all') {
                // Filter by the selected month
                $selectedMonth = request('filter_month');
                $query->wheremonth('date', $selectedMonth);
            }
        } else {
            // untuk menetapkan bulan sekarang saat membuka halaman
            $selectedMonth = request('filter_month', Carbon::now()->month);
            $query->whereMonth('date', $selectedMonth);
        }

        // Query the salary_months based on the selected year, month, and status
        $salary_months = $query->get();

        return view('salary.index', compact('title', 'statuses', 'years', 'months', 'salary_months', 'selectedStatus', 'selectedYear', 'selectedMonth'));
    }

    /**
     * Print one salary data employee.
     */
    public function print($id)
    {
        $sal = SalaryMonth::find($id);

        // mengambeil date
        $date = date('My', strtotime($sal->date));

        if (!$sal) {
            // Log or dd() the ID to see which ID is causing the issue.
            dd("Salary with ID $id not found.");
        }

        // hitungan utuk mendapatkan total gaji bersih
        $rate_salary = $sal->salary_year->salary_grade->rate_salary;
        $ability = $sal->salary_year->ability;
        $fungtional_alw = $sal->salary_year->fungtional_alw;
        $family_alw = $sal->salary_year->family_alw;

        $total = $rate_salary + $ability + $fungtional_alw + $family_alw;

        $pdf = PDF::loadView('salary.print', compact('sal', 'total'));
        return $pdf->setPaper('a5', 'landscape')->stream('SAL_' . $date . '_' . $sal->salary_year->user->nik . '_' . $sal->salary_year->user->name . '.pdf');
    }

    /**
     * Download one salary data employee.
     */
    public function download($id)
    {
        $sal = SalaryMonth::find($id);

        // mengambeil date
        $date = date('My', strtotime($sal->date));

        if (!$sal) {
            // Log or dd() the ID to see which ID is causing the issue.
            dd("Salary with ID $id not found.");
        }

        // hitungan utuk mendapatkan total gaji bersih
        $rate_salary = $sal->salary_year->salary_grade->rate_salary;
        $ability = $sal->salary_year->ability;
        $fungtional_alw = $sal->salary_year->fungtional_alw;
        $family_alw = $sal->salary_year->family_alw;

        $total = $rate_salary + $ability + $fungtional_alw + $family_alw;

        $pdf = PDF::loadView('salary.print', compact('sal', 'total'));
        return $pdf->setPaper('a5', 'landscape')->download('SAL_' . $date . '_'  . $sal->salary_year->user->nik . '_' . $sal->salary_year->user->name . '.pdf');
    }

    /**
     * Print all salary data employee.
     */
    public function printall()
    {
        $monthOpts = SalaryMonth::select(DB::raw('MONTH(date) as month'))
            ->distinct()
            ->pluck('month');

        $yearOpts = SalaryMonth::select(DB::raw('YEAR(date) as year'))
            ->distinct()
            ->pluck('year');

        $year = request()->input('year');
        $month = request()->input('month');

        // $salaries = SalaryMonth::all();
        // Mengambil seluruh data salary_months beserta relasi salary_years-user-status
        // $salaries = SalaryMonth::with(['salary_year.user.status'])->get();
        $salaries = SalaryMonth::with(['salary_year.user.status'])
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // Mengelompokkan salary_months berdasarkan name_status
        $salByStatus = $salaries->groupBy('salary_year.user.status.name_status');

        $date = null;
        foreach ($salaries as $sal) {
            $date = date('F Y', strtotime($sal->date));
        }

        // dd($salByStatus);
        if ($date) {
            $pdf = PDF::loadView('salary.printall', compact('salByStatus', 'date'));
            return $pdf->setPaper('a4', 'landscape')->stream('PrintAll.pdf');
        } else {
            return redirect()->route('salary.index');
        }
    }

    /**
     * Print all salary data employee.
     */
    public function printallocation()
    {
        $monthOpts = SalaryMonth::select(DB::raw('MONTH(date) as month'))
            ->distinct()
            ->pluck('month');

        $yearOpts = SalaryMonth::select(DB::raw('YEAR(date) as year'))
            ->distinct()
            ->pluck('year');

        $year = request()->input('year');
        $month = request()->input('month');

        $sal_allocation = SalaryMonth::with('salary_year')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $data = [];
        foreach ($sal_allocation as $item) {
            $allocations = json_decode($item->allocation);
            if ($allocations) {
                foreach ($allocations as $div) {
                    $data[$div]['allocation'][] = $div;
                    $data[$div]['rate_salary'][] = $item->salary_year->salary_grade->rate_salary;
                    $data[$div]['ability'][] = $item->salary_year->ability;
                    $data[$div]['fungtional_alw'][] = $item->salary_year->fungtional_alw;
                    $data[$div]['family_alw'][] = $item->salary_year->family_alw;
                    $data[$div]['transport_alw'][] = $item->salary_year->transport_alw;
                    $data[$div]['adjustment'][] = $item->salary_year->adjustment;
                    $data[$div]['bpjs'][] = $item->salary_year->bpjs;
                    $data[$div]['jamsostek'][] = $item->salary_year->jamsostek;
                    $data[$div]['total_ben'][] = $item->salary_year->total_ben;
                    $data[$div]['total_ben_ded'][] = $item->salary_year->total_ben_ded;
                    $data[$div]['total_overtime'][] = $item->total_overtime;
                    $data[$div]['thr'][] = $item->thr;
                    $data[$div]['bonus'][] = $item->bonus;
                    $data[$div]['incentive'][] = $item->incentive;
                    $data[$div]['union'][] = $item->union;
                    $data[$div]['absent'][] = $item->absent;
                    $data[$div]['electricity'][] = $item->electricity;
                    $data[$div]['cooperative'][] = $item->cooperative;
                    $data[$div]['gross_salary'][] = $item->gross_salary;
                    $data[$div]['total_deduction'][] = $item->total_deduction;
                    $data[$div]['net_salary'][] = $item->net_salary;
                }
            } else {
                return redirect()->route('salary.index');
            }
        }

        $finalResult = [];

        foreach ($data as $div => $values) {
            $finalResult[] = [
                'allocation' => $div,
                'rate_salary' => array_sum($values['rate_salary']),
                'ability' => array_sum($values['ability']),
                'fungtional_alw' => array_sum($values['fungtional_alw']),
                'family_alw' => array_sum($values['family_alw']),
                'transport_alw' => array_sum($values['transport_alw']),
                'adjustment' => array_sum($values['adjustment']),
                'bpjs' => array_sum($values['bpjs']),
                'jamsostek' => array_sum($values['jamsostek']),
                'total_ben' => array_sum($values['total_ben']),
                'total_ben_ded' => array_sum($values['total_ben_ded']),
                'total_overtime' => array_sum($values['total_overtime']),
                'thr' => array_sum($values['thr']),
                'bonus' => array_sum($values['bonus']),
                'incentive' => array_sum($values['incentive']),
                'union' => array_sum($values['union']),
                'absent' => array_sum($values['absent']),
                'electricity' => array_sum($values['electricity']),
                'cooperative' => array_sum($values['cooperative']),
                'gross_salary' => array_sum($values['gross_salary']),
                'total_deduction' => array_sum($values['total_deduction']),
                'net_salary' => array_sum($values['net_salary']),
            ];
        }

        // At the end of the displayTable method
        $grandTotal = [
            'rate_salary' => 0,
            'ability' => 0,
            'fungtional_alw' => 0,
            'family_alw' => 0,
            'transport_alw' => 0,
            'adjustment' => 0,
            'bpjs' => 0,
            'jamsostek' => 0,
            'total_ben' => 0,
            'total_ben_ded' => 0,
            'total_overtime' => 0,
            'thr' => 0,
            'bonus' => 0,
            'incentive' => 0,
            'union' => 0,
            'absent' => 0,
            'electricity' => 0,
            'cooperative' => 0,
            'gross_salary' => 0,
            'total_deduction' => 0,
            'net_salary' => 0,
        ];

        if (!empty($finalResult)) {
            $grandTotal = [
                'rate_salary' =>  array_sum(array_column($finalResult, 'rate_salary')),
                'ability' => array_sum(array_column($finalResult, 'ability')),
                'fungtional_alw' => array_sum(array_column($finalResult, 'fungtional_alw')),
                'family_alw' => array_sum(array_column($finalResult, 'family_alw')),
                'transport_alw' => array_sum(array_column($finalResult, 'transport_alw')),
                'adjustment' => array_sum(array_column($finalResult, 'adjustment')),
                'bpjs' => array_sum(array_column($finalResult, 'bpjs')),
                'jamsostek' => array_sum(array_column($finalResult, 'jamsostek')),
                'total_ben' => array_sum(array_column($finalResult, 'total_ben')),
                'total_ben_ded' => array_sum(array_column($finalResult, 'total_ben_ded')),
                'total_overtime' => array_sum(array_column($finalResult, 'total_overtime')),
                'thr' => array_sum(array_column($finalResult, 'thr')),
                'bonus' => array_sum(array_column($finalResult, 'bonus')),
                'incentive' => array_sum(array_column($finalResult, 'incentive')),
                'union' => array_sum(array_column($finalResult, 'union')),
                'absent' => array_sum(array_column($finalResult, 'absent')),
                'electricity' => array_sum(array_column($finalResult, 'electricity')),
                'cooperative' => array_sum(array_column($finalResult, 'cooperative')),
                'gross_salary' => array_sum(array_column($finalResult, 'gross_salary')),
                'total_deduction' => array_sum(array_column($finalResult, 'total_deduction')),
                'net_salary' => array_sum(array_column($finalResult, 'net_salary')),
            ];
        }

        // debuging
        // dd($grandTotal['rate_salary']);

        $date = null;
        foreach ($sal_allocation as $sal) {
            $date = date('F Y', strtotime($sal->date));
        }

        if ($date) {
            $pdf = PDF::loadView('salary.printallocation', compact('sal_allocation', 'date', 'finalResult', 'grandTotal'));
            return $pdf->setPaper('a4', 'landscape')->stream('PrintAllocation' . $date . '.pdf');
        } else {
            return redirect()->route('salary.index');
        }
    }
}
