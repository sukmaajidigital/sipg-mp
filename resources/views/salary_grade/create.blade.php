@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Input salary data per grade</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        {{-- bagian ditampilkan di awal apabila data gaji per grade tahun ini belum di isi --}}
                        <div class="row">
                            <div class="col">
                                @if ($existingData > 0)
                                    <p>Salary data per grade for {{ $currentYear }} has been entered.</p>
                                @else
                                    <p>Input salary data per grade in {{ $currentYear }}</p>
                                    <button type="button" class="btn btn-primary btn-sm">Input</button>
                                    <a type="button" href="{{ route('salarygrade.index') }}"
                                        class="btn btn-outline-secondary btn-sm">Cancel</a>
                                @endif
                            </div>
                        </div>
                        {{-- bagian ditampilkan di awal --}}
                        {{-- bagian ditampilkan setelah menekan tombol --}}
                        <form action="{{ route('salarygrade.store') }}" method="post" id="salaryForm" style="display:none"
                            class="salary-grade-form">
                            <hr class="horizontal dark my-3">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-sm px-4">Save</button>
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
                                                @foreach ($grades as $key => $grade)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $grade->name_grade }}</td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    name="rate_salary[{{ $grade->id }}]"
                                                                    placeholder="Enter the salary amount">
                                                            </div>
                                                            {{-- <input type="number" name="rate_salary[{{ $grade->id }}]"
                                                                placeholder="Enter the salary amount"> --}}
                                                        </td>
                                                        <td>{{ $currentYear }}</td>
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
    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika JavaScript untuk menampilkan/menyembunyikan form input
            const inputButton = document.querySelector('.btn-primary');
            const salaryForm = document.getElementById('salaryForm');

            inputButton.addEventListener('click', function() {
                salaryForm.style.display = 'block';
            });
        });
    </script>
