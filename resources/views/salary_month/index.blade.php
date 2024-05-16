@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Salary Data Per Month</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <div class="row">
                            <div class="col-8">
                                <a href="{{ url('/salary-month/create') }}" class="btn btn-info btn-sm">Input Data</a>
                                {{-- <a href="{{ url('/salarygrade/create') }}" class="btn btn-warning btn-sm">Edit Data</a> --}}
                                <button type="button" class="btn btn-warning btn-sm" id="editButton">Edit Data</button>
                                <button type="button" class="btn btn-warning btn-sm" id="chooseButton"
                                    style="display: none;">Choose Data</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="cancelButton"
                                    style="display: none;">Cancel</button>
                            </div>
                            <div class="col-4 justify-content-end">
                                <form action="{{ url('/salary-month') }}" method="GET">
                                    <div class="row">
                                        <div class="col pe-0">
                                            <select class="form-select form-select-sm" name="filter_status">
                                                <option value="" {{ $selectedStatus == 'all' ? 'selected' : '' }}>
                                                    Show All Status
                                                </option>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status }}"
                                                        {{ $selectedStatus == $status ? 'selected' : '' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col pe-0">
                                            <select class="form-select form-select-sm" name="filter_year">
                                                <option value="all" {{ $selectedYear == 'all' ? 'selected' : '' }}>
                                                    Show All Year
                                                </option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year }}"
                                                        {{ $selectedYear == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col pe-0">
                                            <select class="form-select form-select-sm" name="filter_month">
                                                <option value="all" {{ $selectedMonth == 'all' ? 'selected' : '' }}>
                                                    Show All Month
                                                </option>
                                                @foreach ($months as $month)
                                                    <option value="{{ $month['value'] }}"
                                                        {{ $selectedMonth == $month['value'] ? 'selected' : '' }}>
                                                        {{ $month['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table
                                class="table table-sm table-striped table-hover dtTable100 align-items-center compact small-tbl">
                                <thead class="bg-thead">
                                    <tr>
                                        <th colspan="6" class="text-center p-0">Employee Identity</th>
                                        <th colspan="7" class="text-center p-0">Salary Components</th>
                                        <th colspan="4" class="text-center p-0">Deduction</th>
                                        <th rowspan="2" class="text-center">Allocation</th>
                                        <th rowspan="2" class="text-center">Month / Year</th>
                                        <th rowspan="2" style="display: none;"><input type="checkbox" id="checkAll">
                                        </th>
                                        {{-- <th rowspan="2" class="text-center">Action</th> --}}
                                    </tr>
                                    <tr>
                                        <th style="background-color: #1A73E8;color: white;">Emp Code</th>
                                        <th style="background-color: #1A73E8;color: white;">Name</th>
                                        <th>Status</th>
                                        <th>Dept</th>
                                        <th>Job</th>
                                        <th>Grade</th>
                                        <th>Salary Grade</th>
                                        <th>Ability</th>
                                        <th>Hour Call</th>
                                        <th>Total Overtime</th>
                                        <th>THR</th>
                                        <th>Bonus</th>
                                        <th>Incentive</th>
                                        <th>Union</th>
                                        <th>Absent</th>
                                        <th>Electricity</th>
                                        <th>Cooperative</th>
                                        {{-- <th>Tanggal Pengisian</th> --}}
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salary_months as $key => $sm)
                                        <tr>
                                            <td class="text-nowrap text-end">{{ $sm->salary_year->user->nik }}</td>
                                            <td>{{ $sm->salary_year->user->name }}</td>
                                            <td>{{ $sm->salary_year->user->status->name_status }}</td>
                                            <td>{{ $sm->salary_year->user->dept->name_dept }}</td>
                                            <td>{{ $sm->salary_year->user->job->name_job }}</td>
                                            <td>{{ $sm->salary_year->user->grade->name_grade }}</td>
                                            <td class="text-end">
                                                {{ number_format($sm->salary_year->salary_grade->rate_salary, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($sm->salary_year->ability, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                {{ $sm->hour_call }} h
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($sm->total_overtime, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($sm->thr, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($sm->bonus, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($sm->incentive, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($sm->union, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ number_format($sm->absent, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ number_format($sm->electricity, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ number_format($sm->cooperative, 0, ',', '.') }}</td>
                                            <td>@php
                                                $allocations = json_decode($sm->allocation);
                                                if (is_array($allocations)) {
                                                    echo implode(', ', $allocations);
                                                } else {
                                                    echo $allocations;
                                                }
                                            @endphp</td>
                                            <td class="text-end">{{ date('M/Y', strtotime($sm->date)) }}</td>
                                            <td style="display: none;"><input type="checkbox" name="selected[]"
                                                    value="{{ $sm->id }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Script untuk menangani tombol dan check dinamis --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButton = document.getElementById('editButton');
                const chooseButton = document.getElementById('chooseButton');
                const cancelButton = document.getElementById('cancelButton');
                const checkAll = document.getElementById('checkAll');
                const checkboxes = document.querySelectorAll('input[name="selected[]"]');
                const hiddenTh = document.querySelector('th[style="display: none;"]');
                const hiddenTd = document.querySelectorAll('td[style="display: none;"]');

                // Handle event "Check All"
                checkAll.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = checkAll.checked;
                    });
                });


                editButton.addEventListener('click', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.closest('td').style.display = 'block';
                    });

                    chooseButton.style.display = 'inline-block';
                    cancelButton.style.display = 'inline-block';
                    editButton.style.display = 'none';
                    hiddenTh.style.display = 'block';
                    hiddenTd.forEach(td => td.style.display = 'block');
                });

                cancelButton.addEventListener('click', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.closest('td').style.display = 'none';
                    });

                    chooseButton.style.display = 'none';
                    cancelButton.style.display = 'none';
                    editButton.style.display = 'inline-block';
                    hiddenTh.style.display = 'none';
                    hiddenTd.forEach(td => td.style.display = 'none');
                });

                chooseButton.addEventListener('click', function() {
                    const selectedIds = Array.from(checkboxes)
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => `ids[]=${checkbox.value}`)
                        .join('&');

                    // Redirect ke halaman edit dengan parameter ids yang dipilih
                    window.location.href = `/salary-month/edit?${selectedIds}`;
                });

            });
        </script>
    @endsection
