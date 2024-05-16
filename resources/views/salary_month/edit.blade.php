@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Edit Salary Data Per Month</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <form action="{{ route('salary-month.update_multiple') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    <a href="{{ route('salary-month.index') }}"
                                        class="btn btn-outline-secondary btn-sm">Cancel</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive p-0">
                                        <table
                                            class="table table-sm align-items-center mb-0 dtTable small-tbl compact stripe">
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
                                                @foreach ($salary_months as $key => $sm)
                                                    <tr>
                                                        <td class="text-end">{{ $key + 1 }}</td>
                                                        <td class="text-nowrap text-end">{{ $sm->salary_year->user->nik }}
                                                        </td>
                                                        <td>{{ $sm->salary_year->user->name }}</td>
                                                        <td>{{ $sm->salary_year->user->status->name_status }}</td>
                                                        <td>{{ $sm->salary_year->user->dept->name_dept }}</td>
                                                        <td>{{ $sm->salary_year->user->job->name_job }}</td>
                                                        <td>{{ $sm->salary_year->user->grade->name_grade ?? '-' }}</td>
                                                        <td class="text-end">
                                                            @if ($sm->salary_year->user->grade && $sm->salary_year->user->grade->salary_grades->isNotEmpty())
                                                                {{ number_format($sm->salary_year->salary_grade->rate_salary, 0, ',', '.') }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td class="text-end">
                                                            {{ number_format($sm->salary_year->ability, 0, ',', '.') }}
                                                        </td>
                                                        <td>
                                                            {{-- INPUTAN HIDDEN --}}
                                                            <input type="hidden" name="ids[]"
                                                                value="{{ $sm->id }}">

                                                            <input type="hidden" name="id_user[]"
                                                                value="{{ $sm->id_user }}">
                                                            <input type="hidden" name="id_user[]"
                                                                value="{{ $sm->id_user }}">
                                                            <input type="hidden"
                                                                name="id_salary_year[{{ $sm->id }}]"
                                                                value="{{ $sm->id ?? '' }}">
                                                            <input type="hidden" name="rate_salary[{{ $sm->id }}]"
                                                                value="{{ $sm->salary_year->salary_grade->rate_salary ?? '' }}">
                                                            <input type="hidden" name="ability[{{ $sm->id }}]"
                                                                value="{{ $sm->ability ?? '' }}">
                                                            <input type="hidden"
                                                                name="fungtional_alw[{{ $sm->id }}]"
                                                                value="{{ $sm->fungtional_alw ?? '' }}">
                                                            <input type="hidden" name="family_alw[{{ $sm->id }}]"
                                                                value="{{ $sm->family_alw ?? '' }}">
                                                            <input type="hidden" name="transport_alw[{{ $sm->id }}]"
                                                                value="{{ $sm->transport_alw ?? '' }}">
                                                            <input type="hidden" name="adjustment[{{ $sm->id }}]"
                                                                value="{{ $sm->adjustment ?? '' }}">
                                                            <input type="hidden" name="bpjs[{{ $sm->id }}]"
                                                                value="{{ $sm->bpjs ?? '' }}">
                                                            <input type="hidden" name="jamsostek[{{ $sm->id }}]"
                                                                value="{{ $sm->jamsostek ?? '' }}">
                                                            <input type="hidden" name="total_ben[{{ $sm->id }}]"
                                                                value="{{ $sm->total_ben ?? '' }}">
                                                            <input type="hidden" name="total_ben_ded[{{ $sm->id }}]"
                                                                value="{{ $sm->total_ben_ded ?? '' }}">

                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 90px"
                                                                    name="hour_call[{{ $sm->id }}]"
                                                                    placeholder="Enter the overtime hour call"
                                                                    value="{{ $sm->hour_call }}"
                                                                    oninput="calculateTotalOvertime({{ $sm->id }})">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px"
                                                                    name="total_overtime[{{ $sm->id }}]" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px" name="thr[{{ $sm->id }}]"
                                                                    placeholder="Enter the THR"
                                                                    value="{{ $sm->thr }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px"
                                                                    name="bonus[{{ $sm->id }}]"
                                                                    placeholder="Enter the bonus"
                                                                    value="{{ $sm->bonus }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px"
                                                                    name="incentive[{{ $sm->id }}]"
                                                                    placeholder="Enter the incentive"
                                                                    value="{{ $sm->incentive }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px"
                                                                    name="union[{{ $sm->id }}]"
                                                                    placeholder="Enter the union"
                                                                    value="{{ $sm->union }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px"
                                                                    name="absent[{{ $sm->id }}]"
                                                                    placeholder="Enter the absent"
                                                                    value="{{ $sm->absent }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px"
                                                                    name="electricity[{{ $sm->id }}]"
                                                                    placeholder="Enter the electricity"
                                                                    value="{{ $sm->electricity }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    style="width: 120px"
                                                                    name="cooperative[{{ $sm->id }}]"
                                                                    placeholder="Enter the koperasi"
                                                                    value="{{ $sm->cooperative }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <select class="form-select form-select-sm allocation"
                                                                    name="allocation[{{ $sm->id }}][]"
                                                                    style="min-height: 20px;width: 100% !important;padding: 0 0 0 0;"
                                                                    data-placeholder="Select allocation"
                                                                    multiple="multiple">
                                                                    @php
                                                                        $selectedAllocations = json_decode($sm->allocation, true) ?? [];
                                                                    @endphp

                                                                    <option value="A"
                                                                        {{ in_array('A', $selectedAllocations) ? 'selected' : '' }}>
                                                                        A</option>
                                                                    <option value="B"
                                                                        {{ in_array('B', $selectedAllocations) ? 'selected' : '' }}>
                                                                        B</option>
                                                                    <option value="C"
                                                                        {{ in_array('C', $selectedAllocations) ? 'selected' : '' }}>
                                                                        C</option>
                                                                    <option value="D"
                                                                        {{ in_array('D', $selectedAllocations) ? 'selected' : '' }}>
                                                                        D</option>
                                                                    <option value="E"
                                                                        {{ in_array('E', $selectedAllocations) ? 'selected' : '' }}>
                                                                        E</option>
                                                                    <option value="F"
                                                                        {{ in_array('F', $selectedAllocations) ? 'selected' : '' }}>
                                                                        F</option>
                                                                    <option value="Factory"
                                                                        {{ in_array('Factory', $selectedAllocations) ? 'selected' : '' }}>
                                                                        Factory</option>
                                                                    <option value="GAE"
                                                                        {{ in_array('GAE', $selectedAllocations) ? 'selected' : '' }}>
                                                                        GAE</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="text-end">
                                                            {{ date('M/Y', strtotime($sm->date)) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
