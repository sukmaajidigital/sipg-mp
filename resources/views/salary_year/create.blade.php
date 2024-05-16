@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Input Salary Data Per Year</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <form action="{{ route('salary-year.create') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-auto">
                                    <select name="id_status" class="form-select form-select-sm">
                                        <option value="">- Choose Status -</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                @if ($status->id == $selectedStatus) selected @endif>{{ $status->name_status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary btn-sm mb-2">Filter</button>
                                    <a type="button" href="{{ route('salary-year.index') }}"
                                        class="btn btn-outline-secondary btn-sm mb-2">Cancel</a>
                                </div>
                            </div>
                        </form>
                        @if (request()->filled('id_status') && $users->isNotEmpty())
                            <hr class="horizontal dark my-2">
                            <form action="{{ route('salary-year.store') }}" method="post" class="salary-year-form">
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
                                                        <th colspan="6" class="text-center p-0">Employee Identity</th>
                                                        <th colspan="6" class="text-center p-0">Salary Components</th>
                                                        <th rowspan="2" class="text-center">Year</th>
                                                    </tr>
                                                    <tr class="">
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $key => $user)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-nowrap text-end">{{ $user->nik }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->status->name_status }}</td>
                                                            <td>{{ $user->dept->name_dept }}</td>
                                                            <td>{{ $user->job->name_job }}</td>
                                                            <td>{{ $user->grade->name_grade ?? '-' }}</td>
                                                            <td class="text-end">
                                                                @if ($user->grade && $user->grade->salary_grades->isNotEmpty())
                                                                    {{ number_format($user->grade->salary_grades->first()->rate_salary, 0, ',', '.') }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="id_user[]"
                                                                    value="{{ $user->id }}">
                                                                <input type="hidden" name="id_salary_grade[]"
                                                                    value="{{ $user->grade->salary_grades->first()->id ?? '' }}">
                                                                <input type="hidden" name="rate_salary[]"
                                                                    value="{{ $user->grade->salary_grades->first()->rate_salary ?? '' }}">

                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="ability[{{ $key }}]"
                                                                        placeholder="Enter the ability">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="fungtional_alw[{{ $key }}]"
                                                                        placeholder="Enter the fungtional allowance">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="family_alw[{{ $key }}]"
                                                                        placeholder="Enter the family allowance">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="transport_alw[{{ $key }}]"
                                                                        placeholder="Enter the transport allowance">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        style="width: 120px"
                                                                        name="adjustment[{{ $key }}]"
                                                                        placeholder="Enter the adjustment">
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                {{ date('Y') }}
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
        </div>
    @endsection
