@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Salary Data Per Year</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <div class="row">
                            <div class="col-7">
                                <a href="{{ url('/salary-year/create') }}" class="btn btn-info btn-sm">Input Data</a>
                                <button type="button" class="btn btn-warning btn-sm" id="editButton">Edit Data</button>
                                <button type="button" class="btn btn-warning btn-sm" id="chooseButton"
                                    style="display: none;">Choose Data</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="cancelButton"
                                    style="display: none;">Cancel</button>
                            </div>
                            <div class="col-5 justify-content-end">
                                <form action="{{ url('/salary-year') }}" method="GET">
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
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-sm dtTable100 align-items-center small-tbl compact stripe hover"
                                style="font-size: 10pt; font-family: 'Arial', sans-serif;">
                                <thead class="bg-thead">
                                    <tr>
                                        <th colspan="6" class="text-center p-0">Employee Identity</th>
                                        <th colspan="6" class="text-center p-0">Salary Components</th>
                                        <th colspan="2" class="text-center p-0">Deduction</th>
                                        <th rowspan="2" class="text-center">Year</th>
                                        <th rowspan="2" style="display: none;"><input type="checkbox" id="checkAll">
                                        </th>
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
                                        <th>Fungtional Allowance</th>
                                        <th>Family Allowance</th>
                                        <th>Transport Allowance</th>
                                        <th>Adjustment</th>
                                        <th>BPJS Kesehatan</th>
                                        <th>Jamsostek</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salary_years as $key => $sy)
                                        <tr>
                                            <td class="text-nowrap text-end">{{ $sy->user->nik }}</td>
                                            <td>{{ $sy->user->name }}</td>
                                            <td>{{ $sy->user->status->name_status }}</td>
                                            <td>{{ $sy->user->dept->name_dept }}</td>
                                            <td>{{ $sy->user->job->name_job }}</td>
                                            <td>{{ $sy->user->grade->name_grade }}</td>
                                            <td class="text-end">
                                                {{ number_format($sy->salary_grade->rate_salary, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($sy->ability, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ number_format($sy->fungtional_alw, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ number_format($sy->family_alw, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ number_format($sy->transport_alw, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($sy->adjustment, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($sy->bpjs, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($sy->jamsostek, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ $sy->year }}</td>
                                            <td style="display: none;"><input type="checkbox" name="selected[]"
                                                    value="{{ $sy->id }}"></td>
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
                    window.location.href = `/salary-year/edit?${selectedIds}`;
                });

            });
        </script>
    @endsection
