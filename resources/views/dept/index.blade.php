@extends('layouts.main')
@section('content')
    {{-- Bagian  Isi Konten --}}
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Departement Data</h6>
                    </div>
                </div>

                <div class="card-body p-3 pb-2">
                    <button data-bs-toggle="modal" data-bs-target="#addDept" class="btn btn-info btn-sm">Add
                        Data</button>
                    <div class="table-responsive p-0">
                        <table class="table table-small table-striped table-hover dtTable align-items-center compact">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Departement Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($depts as $dept)
                                    <tr>
                                        <td>{{ $dept->id }}</td>
                                        <td>{{ $dept->name_dept }}</td>
                                        <td class="text-center m-0 p-0">
                                            <button class="btn btn-warning btn-icon-only m-0 p-0 btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editDept{{ $dept->id }}"
                                                title="Edit Data">
                                                <span class="btn-inner--icon"><i class="material-icons">edit</i></span>
                                            </button>
                                            <button class="btn btn-danger btn-icon-only m-0 p-0 btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteDept{{ $dept->id }}"
                                                title="Delete Data">
                                                <span class="btn-inner--icon"><i class="material-icons">delete</i></span>
                                            </button>
                                        </td>
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

    {{-- MODAL --}}
    {{-- Modal Add --}}
    <div class="modal fade" id="addDept" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Departement Data</h5>
                        </div>

                        <form action="{{ route('departement.store') }}" method="post" class="add_edit_dept">
                            @csrf
                            <div class="card-body py-0">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Departement Name</label>
                                    <input type="text" class="form-control" name="name_dept">
                                </div>
                            </div>
                            <div class="card-footer text-end pt-0">
                                <button type="button" class="btn btn-sm  btn-outline-secondary m-0" data-bs-dismiss="modal"
                                    onclick="resetForm('add_edit_dept')">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success text-white m-0">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($depts as $dept)
        {{-- Modal Edit --}}
        <div class="modal fade" id="editDept{{ $dept->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-form"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Departement Data</h5>
                            </div>

                            <form action="{{ route('departement.update', $dept->id) }}" method="post"
                                class="add_edit_dept">
                                @csrf {{-- Cross-Site Request Forgery --}}
                                @method('PUT'){{-- Method Override merupakan directive Blade di Laravel --}}

                                <div class="card-body py-0">
                                    <div class="input-group input-group-outline my-3 is-focused">
                                        <label class="form-label">Departement Name</label>
                                        <input type="text" class="form-control"
                                            name="name_dept"value="{{ $dept->name_dept }}">
                                    </div>
                                </div>
                                <div class="card-footer text-end pt-0">
                                    <button type="button" class="btn btn-sm  btn-outline-secondary m-0"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-success text-white m-0">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Delete --}}
        <div class="modal fade" id="deleteDept{{ $dept->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Departement Data</h5>
                            </div>
                            <form action="{{ route('departement.destroy', $dept->id) }}" method="post">
                                @csrf
                                @method('DELETE'){{-- Method Override merupakan directive Blade di Laravel --}}

                                <input type="hidden" class="form-control" name="id" value="{{ $dept->id }}">

                                <p class="mx-3">Apakah anda yakin ingin menghapus data?</p>
                                <div class="card-footer text-end pt-0">
                                    <button type="button" class="btn btn-sm  btn-outline-danger m-0"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-danger text-white m-0">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- /MODAL --}}
@endsection
