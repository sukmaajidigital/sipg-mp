{{-- Modal Add --}}
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User Data</h5>
                    </div>

                    <form action="{{ route('user.store') }}" method="post" class="add_edit_user">
                        @csrf
                        <div class="card-body py-0">
                            {{-- <div class="row my-1">
                                <div class="col-3">
                                    <label for="nik" class="pt-2">Emp Code</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="nik" id="nik"
                                            placeholder="Emp Code">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="name" class="pt-2">Name</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="id_status" class="pt-2">Status</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="id_status">
                                            <option value="">Choose Status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name_status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="id_dept" class="pt-2">Departement</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="id_dept">
                                            <option value="">Choose Departement</option>
                                            @foreach ($depts as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->name_dept }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="id_job" class="pt-2">Job</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="id_job">
                                            <option value="">Choose Job</option>
                                            @foreach ($jobs as $job)
                                                <option value="{{ $job->id }}">{{ $job->name_job }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="id_grade" class="pt-2">Grade</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="id_grade">
                                            <option value="">Choose Grade</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="sex" class="pt-2">Gender</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="sex">
                                            <option value="">Choose Gender</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="ttl" class="pt-2">Date of Birth</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="date" class="form-control" name="ttl">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="start" class="pt-2">Start</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="date" class="form-control" name="start">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="education" class="pt-2">Education</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="education">
                                            <option value="">Choose Education</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SMK">SMK</option>
                                            <option value="MI">MI</option>
                                            <option value="MTs">MTs</option>
                                            <option value="MA">MA</option>
                                            <option value="Paket A">Paket A</option>
                                            <option value="Paket B">Paket B</option>
                                            <option value="Paket C">Paket C</option>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="religion" class="pt-2">Religion</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="religion">
                                            <option value="">Choose Religion</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Katolik">Kristen Katolik</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="domisili" class="pt-2">Domisili</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="domisili"
                                            placeholder="Domisili">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="email" class="pt-2">Email</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="no_ktp" class="pt-2">No KTP</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="no_ktp"
                                            placeholder="No KTP">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="no_telpon" class="pt-2">Telp</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="no_telpon"
                                            placeholder="Telp">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="tax_number" class="pt-2">Tax ID</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="tax_number"
                                            placeholder="Tax ID Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="account_number" class="pt-2">Acc Number</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="account_number"
                                            placeholder="Account Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="status_pernikahan" class="pt-2">Marital Status</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="status_pernikahan">
                                            <option value="">Choose Marital Status</option>
                                            <option value="S0">S0 - Belum Nikah</option>
                                            <option value="K0">K0 - Nikah Anak 0</option>
                                            <option value="K1">K1 - Nikah Anak 1</option>
                                            <option value="K2">K2 - Nikah Anak 2</option>
                                            <option value="K3">K3 - Nikah Anak 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="role_app" class="pt-2">Role User</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-select px-2" name="role_app">
                                            <option value="">Choose Role User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Checker">Checker</option>
                                            <option value="Approver">Approver</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">
                                    <label for="active" class="pt-2">Active Work</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-outline">
                                        <select class="form-control" name="active">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end pt-1">
                            <button type="button" class="btn btn-sm  btn-outline-secondary m-0"
                                data-bs-dismiss="modal" onclick="resetForm('add_edit_user')">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success text-white m-0">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
