@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Input Salary Per Month</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <form action="{{ route('salary-month.create') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-auto pe-0">
                                    <select name="id_status" class="form-select form-select-sm">
                                        <option value="" {{ $statusFilter == null ? 'selected' : '' }}>
                                            - Choose Status -</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $statusFilter == $status->id ? 'selected' : '' }}>
                                                {{ $status->name_status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto pe-0">
                                    <select name="year" class="form-select form-select-sm">
                                        <option value="" {{ $yearFilter == null ? 'selected' : '' }}>
                                            - Choose Year - </option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                {{ $yearFilter == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="month" class="form-select form-select-sm">
                                        <option value="" {{ $monthFilter == null ? 'selected' : '' }}>
                                            - Choose Month - </option>
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}"
                                                {{ $monthFilter == $month ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-primary btn-sm mb-2">Filter</button>
                                    <a type="button" href="{{ route('salary-month.index') }}"
                                        class="btn btn-outline-secondary btn-sm mb-2">Cancel</a>
                                </div>
                            </div>
                        </form>
                        @if (count($salary_years) > 0)
                            <hr class="horizontal dark my-2">
                            <form action="{{ route('salary-month.store') }}" method="post" class="salary-month-form">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success btn-sm px-4">Save</button>
                                    </div>
                                    <div class="col">
                                        <div class="table-responsive p-0">
                                            <table
                                                class="table align-items-center small-tbl dtTableFix3 compact stripe hover">
                                                <thead class="bg-thead">
                                                    <tr>
                                                        <th rowspan="2" class="text-center"
                                                            style="background-color: #1A73E8;color: white;">#</th>
                                                        <th colspan="6" class="text-center p-0">Employee
                                                            Identity</th>
                                                        <th colspan="7" class="text-center p-0">Salary Components</th>
                                                        <th colspan="4" class="text-center p-0">Deduction</th>
                                                        <th rowspan="2" class="text-center">Allocation</th>
                                                        <th rowspan="2" class="text-center">Month / Year</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="background-color: #1A73E8;color: white;">Emp Code</th>
                                                        <th style="background-color: #1A73E8;color: white;">Name</th>
                                                        <th>Status</th>
                                                        <th>Dept</th>
                                                        <th>Job</th>
                                                        <th>Grade</th>
                                                        <th>Rate Salary</th>
                                                        <th>Ability</th>
                                                        <th>Overtime Hour</th>
                                                        <th>Total Overtime</th>
                                                        <th>THR</th>
                                                        <th>Bonus</th>
                                                        <th>Incentive</th>
                                                        <th>Union</th>
                                                        <th>Absent</th>
                                                        <th>Electricity</th>
                                                        <th>Cooperative</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($salary_years as $key => $sy)
                                                        <tr>
                                                            <td class="text-end">{{ $key + 1 }}</td>
                                                            <td class="text-nowrap text-end">{{ $sy->user->nik }}</td>
                                                            <td>{{ $sy->user->name }}</td>
                                                            <td>{{ $sy->user->status->name_status }}</td>
                                                            <td>{{ $sy->user->dept->name_dept }}</td>
                                                            <td>{{ $sy->user->job->name_job }}</td>
                                                            <td>{{ $sy->user->grade->name_grade ?? '-' }}</td>
                                                            <td class="text-end">
                                                                @if ($sy->user->grade && $sy->user->grade->salary_grades->isNotEmpty())
                                                                    {{ number_format($sy->salary_grade->rate_salary, 0, ',', '.') }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-end">
                                                                {{ number_format($sy->ability, 0, ',', '.') }}
                                                            </td>
                                                            <td>
                                                                {{-- INPUTAN HIDDEN --}}
                                                                <input type="hidden" name="id_user[]"
                                                                    value="{{ $sy->id_user }}">
                                                                <input type="hidden" name="id_salary_grade[]"
                                                                    value="{{ $sy->salary_grade->id ?? '' }}">
                                                                <input type="hidden"
                                                                    name="id_salary_year[{{ $key }}]"
                                                                    value="{{ $sy->id ?? '' }}">
                                                                <input type="hidden"
                                                                    name="rate_salary[{{ $key }}]"
                                                                    value="{{ $sy->salary_grade->rate_salary ?? '' }}">
                                                                <input type="hidden" name="ability[{{ $key }}]"
                                                                    value="{{ $sy->ability ?? '' }}">
                                                                <input type="hidden"
                                                                    name="fungtional_alw[{{ $key }}]"
                                                                    value="{{ $sy->fungtional_alw ?? '' }}">
                                                                <input type="hidden"
                                                                    name="family_alw[{{ $key }}]"
                                                                    value="{{ $sy->family_alw ?? '' }}">
                                                                <input type="hidden"
                                                                    name="transport_alw[{{ $key }}]"
                                                                    value="{{ $sy->transport_alw ?? '' }}">
                                                                <input type="hidden"
                                                                    name="adjustment[{{ $key }}]"
                                                                    value="{{ $sy->adjustment ?? '' }}">
                                                                <input type="hidden" name="bpjs[{{ $key }}]"
                                                                    value="{{ $sy->bpjs ?? '' }}">
                                                                <input type="hidden" name="jamsostek[{{ $key }}]"
                                                                    value="{{ $sy->jamsostek ?? '' }}">
                                                                <input type="hidden" name="total_ben[{{ $key }}]"
                                                                    value="{{ $sy->total_ben ?? '' }}">
                                                                <input type="hidden"
                                                                    name="total_ben_ded[{{ $key }}]"
                                                                    value="{{ $sy->total_ben_ded ?? '' }}">

                                                                <input type="hidden" name="year"
                                                                    value="{{ $yearFilter }}">
                                                                <input type="hidden" name="month"
                                                                    value="{{ $monthFilter }}">
                                                                {{-- /INPUTAN HIDDEN --}}

                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 90px"
                                                                        name="hour_call[{{ $key }}]"
                                                                        placeholder="Enter the overtime hour call"
                                                                        oninput="calculateTotalOvertime({{ $key }})">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="total_overtime[{{ $key }}]"
                                                                        readonly>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="thr[{{ $key }}]"
                                                                        placeholder="Enter the THR">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="bonus[{{ $key }}]"
                                                                        placeholder="Enter the bonus">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="incentive[{{ $key }}]"
                                                                        placeholder="Enter the incentive">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="union[{{ $key }}]"
                                                                        placeholder="Enter the union">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="absent[{{ $key }}]"
                                                                        placeholder="Enter the absent">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="electricity[{{ $key }}]"
                                                                        placeholder="Enter the electricity">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="cooperative[{{ $key }}]"
                                                                        placeholder="Enter the koperasi">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <select class="form-select form-select-sm allocation"
                                                                        name="allocation[{{ $key }}][]"
                                                                        style="min-height: 20px;width: 100% !important;padding: 0 0 0 0;"
                                                                        data-placeholder="Select allocation"
                                                                        multiple="multiple">
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                        <option value="C">C</option>
                                                                        <option value="D">D</option>
                                                                        <option value="E">E</option>
                                                                        <option value="F">F</option>
                                                                        <option value="Factory">Factory</option>
                                                                        <option value="GAE">GAE</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                {{ $monthFilter ? date('M/Y', strtotime($yearFilter . '-' . $monthFilter . '-01')) : '' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-light    mt-3">
                                No data available for the selected filter.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- SCRIPT untuk perhitungan Total Overtime otomatis berdasarkan jam --}}
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const hourCallInputs = document.querySelectorAll('[name^="hour_call["]');

                    hourCallInputs.forEach(input => {
                        input.addEventListener('input', function() {
                            calculateTotalOvertime(this);
                        });
                    });

                    function calculateTotalOvertime(input) {
                        const key = input.name.match(/\[(\d+)\]/)[1];
                        const rateSalary = parseFloat(document.querySelector(`[name="rate_salary[${key}]"]`).value) || 0;
                        const ability = parseFloat(document.querySelector(`[name="ability[${key}]"]`).value) || 0;

                        const totalOvertimeInput = document.querySelector(`[name="total_overtime[${key}]"]`);

                        if (!isNaN(rateSalary) && !isNaN(ability)) {
                            const hourCall = parseFloat(input.value) || 0;
                            const totalOvertime = ((rateSalary + ability) / 173) * hourCall;
                            totalOvertimeInput.value = totalOvertime.toFixed(2);
                        } else {
                            totalOvertimeInput.value = '';
                        }
                    }
                });
            </script>
            {{-- /SCRIPT --}}
        @endsection
