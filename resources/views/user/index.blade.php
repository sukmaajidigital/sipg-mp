@extends('layouts.main')
@section('content')
    {{-- Bagian  Isi Konten --}}
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Users Data</h6>
                    </div>
                </div>

                <div class="card-body p-3 pb-2">
                    <button data-bs-toggle="modal" data-bs-target="#addUser" class="btn btn-info btn-sm">Add
                        Data</button>
                    <div class="table-responsive p-0">
                        <table class="table table-striped table-hover dtTable align-items-center small_tbl compact">
                            <thead class="bg-thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Emp Code</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Dept</th>
                                    <th>Job</th>
                                    <th>Grade</th>
                                    <th>Gender</th>
                                    <th>D.O.B</th>
                                    <th>Start</th>
                                    <th>Education</th>
                                    <th>Religion</th>
                                    <th>Domisili</th>
                                    <th>Email</th>
                                    <th>No KTP</th>
                                    <th>No Telpon</th>
                                    {{-- <th>KIS</th> --}}
                                    {{-- <th>KJP</th> --}}
                                    {{-- <th>Suku</th> --}}
                                    {{-- <th>No Sepatu Safety</th> --}}
                                    {{-- <th>Start Work User</th> --}}
                                    {{-- <th>End Work User</th> --}}
                                    {{-- <th>Loc Kerja</th> --}}
                                    {{-- <th>Loc</th> --}}
                                    {{-- <th>Sistem Absensi</th> --}}
                                    {{-- <th>Latitude</th> --}}
                                    {{-- <th>Longitude</th> --}}
                                    {{-- <th>Aktual Cuti</th> --}}
                                    <th>Marital Status</th>
                                    {{-- <th>Istri Suami</th>
                                    <th>Anak 1</th>
                                    <th>Anak 2</th>
                                    <th>Anak 3</th> --}}
                                    {{-- <th>Access By</th> --}}
                                    {{-- <th>Image Url</th> --}}
                                    <th>Role App</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->nik }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->status->name_status }}</td>
                                        <td>{{ $user->dept->name_dept }}</td>
                                        <td>{{ $user->job->name_job }}</td>
                                        <td>{{ $user->grade->name_grade ?? '-' }}</td>
                                        <td>{{ $user->sex }}</td>
                                        <td>{{ $user->ttl }}</td>
                                        <td>{{ $user->start }}</td>
                                        <td>{{ $user->pendidikan }}</td>
                                        <td>{{ $user->agama }}</td>
                                        <td>{{ $user->domisili }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_ktp }}</td>
                                        <td>{{ $user->no_telpon }}</td>
                                        {{-- <td>{{ $user->kis }}</td> --}}
                                        {{-- <td>{{ $user->kpj }}</td> --}}
                                        {{-- <td>{{ $user->suku }}</td> --}}
                                        {{-- <td>{{ $user->no_sepatu_safety }}</td> --}}
                                        {{-- <td>{{ $user->start_work_user }}</td> --}}
                                        {{-- <td>{{ $user->end_work_user }}</td> --}}
                                        {{-- <td>{{ $user->loc_kerja }}</td> --}}
                                        {{-- <td>{{ $user->loc }}</td> --}}
                                        {{-- <td>{{ $user->sistem_absensi }}</td> --}}
                                        {{-- <td>{{ $user->latitude }}</td> --}}
                                        {{-- <td>{{ $user->longitude }}</td> --}}
                                        {{-- <td>{{ $user->aktual_cuti }}</td> --}}
                                        <td>{{ $user->status_pernikahan }}</td>
                                        {{-- <td>{{ $user->istri_suami }}</td>
                                        <td>{{ $user->anak_1 }}</td>
                                        <td>{{ $user->anak_2 }}</td>
                                        <td>{{ $user->anak_3 }}</td> --}}
                                        {{-- <td>{{ $user->access_by }}</td> --}}
                                        {{-- <td>{{ $user->image_url }}</td> --}}
                                        <td>{{ $user->role_app }}</td>
                                        <td>{{ $user->active }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /Bagian  Isi Konten --}}
    @include('user/modaladd')
@endsection
