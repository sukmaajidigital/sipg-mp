<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Models\SalaryYear;
use App\Models\SalaryMonth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class SalaryMonthController extends Controller
{
    /** 
     * Display a listing of the resource. 
     */
    public function index()
    {
        $title = 'Salary Per Month';

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

        return view('salary_month.index', compact('title', 'statuses', 'years', 'months', 'salary_months', 'selectedStatus', 'selectedYear', 'selectedMonth'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Input Salary Per Month';
        $statuses = Status::all();

        // Fetch all years and months from the salary_years table
        $years = SalaryYear::distinct('year')->pluck('year')->toArray();

        // Set default values for filters
        $statusFilter = request()->input('id_status', null);
        $yearFilter = request()->input('year', null);
        $monthFilter = request()->input('month', null);

        // Check if all filters are provided, then fetch data
        $salary_years = [];
        if ($statusFilter !== null && $yearFilter !== null && $monthFilter !== null) {
            $salary_years = SalaryYear::when($statusFilter, function ($query) use ($statusFilter) {
                $query->whereHas('user', function ($subquery) use ($statusFilter) {
                    $subquery->where('id_status', $statusFilter);
                });
            })
                ->when($yearFilter, function ($query) use ($yearFilter) {
                    $query->where('year', $yearFilter);
                })
                ->with('user')
                ->get();

            // Filter out the years that already have data for the selected month
            $salary_years = $salary_years->filter(function ($salary_year) use ($monthFilter) {
                return !$salary_year->hasSalaryForMonth($salary_year->year, $monthFilter);
            });
        }

        return view('salary_month.create', compact('title', 'statuses', 'salary_years', 'years', 'statusFilter', 'yearFilter', 'monthFilter'));
    }

    public function store(Request $request)
    {
        // Mengambil tahun dan bulan dari filter
        $yearFilter = $request->input('year');
        $monthFilter = $request->input('month');

        foreach ($request->input('id_user') as $key => $id_user) {
            // Menggabungkan tahun, bulan, dan tanggal tertentu (misalnya, tanggal 1)
            $date = $yearFilter . '-' . $monthFilter . '-13';

            $rate_salary = $request->input('rate_salary')[$key];
            $ability = $request->input('ability')[$key];
            $fungtional_alw = $request->input('fungtional_alw')[$key];
            $family_alw = $request->input('family_alw')[$key];
            $transport_alw = $request->input('transport_alw')[$key];
            $adjustment = $request->input('adjustment')[$key];
            $total_overtime = $request->input('total_overtime')[$key];
            $thr = $request->input('thr')[$key];
            $bonus = $request->input('bonus')[$key];
            $incentive = $request->input('incentive')[$key];
            $total_ben = $request->input('total_ben')[$key];

            $bpjs = $request->input('bpjs')[$key];
            $jamsostek = $request->input('jamsostek')[$key];
            $union = $request->input('union')[$key];
            $absent = $request->input('absent')[$key];
            $electricity = $request->input('electricity')[$key];
            $cooperative = $request->input('cooperative')[$key];
            $total_ben_ded = $request->input('total_ben_ded')[$key];

            // Hitungan untuk mencari totalan
            $gross_sal = $rate_salary + $ability + $fungtional_alw + $family_alw + $transport_alw +
                $adjustment + $total_overtime + $thr + $bonus + $incentive;
            $total_deduction = $bpjs + $jamsostek + $union + $absent + $electricity + $cooperative;
            $net_salary = ($gross_sal + $total_ben) - ($total_deduction + $total_ben_ded);

            $allocations = $request->input('allocation')[$key] ?? NULL;
            if ($allocations) {
                $allocationJson = json_encode($allocations);
            } else {
                $allocationJson = $allocations;
            }

            SalaryMonth::create([
                'id_salary_year' => $request->input('id_salary_year')[$key],
                'date' => $date,
                'hour_call' => $request->input('hour_call')[$key],
                'total_overtime' => $total_overtime,
                'thr' => $thr,
                'bonus' => $bonus,
                'incentive' => $incentive,
                'union' => $union,
                'absent' => $absent,
                'electricity' => $electricity,
                'cooperative' => $cooperative,
                'incentive' => $incentive,
                'gross_salary' => $gross_sal,
                'total_deduction' => $total_deduction,
                'allocation' => $allocationJson,
                'net_salary' => $net_salary,
            ]);
        }

        // Redirect or return response as needed
        return redirect()->route('salary-month.index')->with('success', 'Salary data stored successfully');
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
            return redirect()->route('salary-month.index')->with('error', 'No data selected for editing.');
        }

        $title = 'Salary Per Month';
        $salary_months = SalaryMonth::whereIn('id', $selectedIds)->get();

        return view('salary_month.edit', compact('title', 'salary_months'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        foreach ($request->input('ids') as $id) {

            $rate_salary = $request->input('rate_salary.' . $id);
            $ability = $request->input('ability.' . $id);
            $fungtional_alw = $request->input('fungtional_alw.' . $id);
            $family_alw = $request->input('family_alw.' . $id);
            $transport_alw = $request->input('transport_alw.' . $id);
            $adjustment = $request->input('adjustment.' . $id);
            $total_overtime = $request->input('total_overtime.' . $id);
            $thr = $request->input('thr.' . $id);
            $bonus = $request->input('bonus.' . $id);
            $incentive = $request->input('incentive.' . $id);
            $total_ben = $request->input('total_ben.' . $id);

            $bpjs = $request->input('bpjs.' . $id);
            $jamsostek = $request->input('jamsostek.' . $id);
            $union = $request->input('union.' . $id);
            $absent = $request->input('absent.' . $id);
            $electricity = $request->input('electricity.' . $id);
            $cooperative = $request->input('cooperative.' . $id);
            $total_ben_ded = $request->input('total_ben_ded.' . $id);

            // Hitungan untuk mencari totalan
            $gross_sal = $rate_salary + $ability + $fungtional_alw + $family_alw + $transport_alw +
                $adjustment + $total_overtime + $thr + $bonus + $incentive;
            $total_deduction = $bpjs + $jamsostek + $union + $absent + $electricity + $cooperative;
            $net_salary = ($gross_sal + $total_ben) - ($total_deduction + $total_ben_ded);

            $allocations = $request->input('allocation.' . $id) ?? NULL;
            if ($allocations) {
                $allocationJson = json_encode($allocations);
            } else {
                $allocationJson = $allocations;
            }

            SalaryMonth::where('id', $id)->update([
                'hour_call' => $request->input('hour_call.' . $id),
                'total_overtime' => $total_overtime,
                'thr' => $thr,
                'bonus' => $bonus,
                'incentive' => $incentive,
                'union' => $union,
                'absent' => $absent,
                'electricity' => $electricity,
                'cooperative' => $cooperative,
                'incentive' => $incentive,
                'gross_salary' => $gross_sal,
                'total_deduction' => $total_deduction,
                'allocation' => $allocationJson,
                'net_salary' => $net_salary,
            ]);
        }

        // Redirect atau lakukan aksi lainnya setelah pembaruan selesai
        return redirect()->route('salary-month.index')->with('success', 'Data gaji berhasil diperbarui.');
    }
}
