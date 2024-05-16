@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 position-relative z-index-2">
                {{-- <div class="card card-plain mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column h-100">
                            <h2 class="font-weight-bolder mb-0">Dashboard</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}

                <div class="row">
                    <div class="col-lg-3 col-sm-4">
                        <div class="card  mb-2">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">account_box</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total</p>
                                    <h4 class="mb-0">{{ $managerCount }}</h4>
                                </div>
                            </div>

                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                    Manager
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4">
                        <div class="card  mb-2">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-warning shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">assignment_ind</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total</p>
                                    <h4 class="mb-0">{{ $staffCount }}</h4>
                                </div>
                            </div>

                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                    Staff
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 mt-sm-0 mt-4">
                        <div class="card  mb-2">
                            <div class="card-header p-3 pt-2 bg-transparent">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">supervisor_account</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total</p>
                                    <h4 class="mb-0">{{ $assistantTraineeCount }}</h4>
                                </div>
                            </div>

                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                    Assistant Trainee
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4">

                        <div class="card ">
                            <div class="card-header p-3 pt-2 bg-transparent">
                                <div
                                    class="icon icon-lg icon-shape bg-warning shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">groups</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total</p>
                                    <h4 class="mb-0">{{ $monthlyCount }}</h4>
                                </div>
                            </div>

                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                    Monthly
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <p>Selamat datang di Sistem Informasi Penggajian</p>
                                <p class="mb-0"><b>PT. Bridgestone Kalimantan Plantation</b></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endsection
