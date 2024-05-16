@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Edit Salary Data Per Grade</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <form action="{{ route('salarygrade.update_multiple') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    <a href="{{ route('salarygrade.index') }}"
                                        class="btn btn-outline-secondary btn-sm">Cancel</a>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive p-0">
                                        <table
                                            class="table table-sm align-items-center mb-0 dtTable small-tbl compact stripe ms-0"
                                            width="50%">
                                            <thead class="bg-thead">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Grade</th>
                                                    <th>Salary Grade</th>
                                                    <th>Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($salary_grades as $key => $sg)
                                                    <tr>
                                                        <input type="hidden" name="ids[]" value="{{ $sg->id }}">
                                                        <input type="hidden" name="grade_ids[{{ $sg->id }}]"
                                                            value="{{ $sg->id_grade }}">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $sg->grade->name_grade }}</td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    name="rate_salary[{{ $sg->id }}]"
                                                                    value="{{ $sg->rate_salary }}"
                                                                    placeholder="Enter the salary amount">
                                                            </div>
                                                            {{-- <input type="number" name="rate_salary[{{ $grade->id }}]"
                                                                    placeholder="Enter the salary amount"> --}}
                                                        </td>
                                                        <td>{{ $sg->year }}</td>
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
@endsection
