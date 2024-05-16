@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Salary data per grade</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <div class="row">
                            <div class="col-8">
                                <a href="{{ url('/salarygrade/create') }}" class="btn btn-info btn-sm">Input Data</a>
                                {{-- <a href="{{ url('/salarygrade/create') }}" class="btn btn-warning btn-sm">Edit Data</a> --}}
                                <button type="button" class="btn btn-warning btn-sm" id="editButton">Edit Data</button>
                                <button type="button" class="btn btn-warning btn-sm" id="chooseButton"
                                    style="display: none;">Choose Data</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="cancelButton"
                                    style="display: none;">Cancel</button>
                            </div>
                            <div class="col-4 justify-content-end">
                                <form action="{{ url('/salarygrade') }}" method="GET">
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-select form-select-sm " name="filter_year">
                                                <option value="all" {{ $selectedYear == 'all' ? 'selected' : '' }}>
                                                    Show All Data</option>
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
                            <table class="table table-sm align-items-center dtTable small-tbl compact stripe ms-0"
                                width="50%">
                                <thead class="bg-thead">
                                    <tr>
                                        <th style="display: none;"><input type="checkbox" id="checkAll"></th>
                                        <th>No</th>
                                        <th>Grade</th>
                                        <th>Rate Salary</th>
                                        <th>Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salary_grades as $key => $sg)
                                        <tr>
                                            <td style="display: none;"><input type="checkbox" name="selected[]"
                                                    value="{{ $sg->id }}"></td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $sg->grade->name_grade }}</td>
                                            <td class="text-end">{{ number_format($sg->rate_salary, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ $sg->year }}</td>
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
                    window.location.href = `/salarygrade/edit?${selectedIds}`;
                });

            });
        </script>
    @endsection
