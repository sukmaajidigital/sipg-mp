@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 position-relative z-index-2">
                    <div class="row">
                        <div class="col-lg-4 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">

                                    <div class="text pt-1">
                                        <p class="text-sm mb-1 text-capitalize">Saldo</p>
                                        <h4 class="mb-0">Rp. </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    
                                    <div class="text pt-1">
                                        <p class="text-sm mb-1 text-capitalize">Belum Terbayar</p>
                                        <h4 class="mb-0">Rp.</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    
                                    <div class="text pt-1">
                                        <p class="text-sm mb-1 text-capitalize">Terbayar</p>
                                        <h4 class="mb-0">Rp. </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-3">
                            <div class="card mb-2">
                                <div class="card-header p-3 pt-2">
                                    <p class="text-sm mb-1 text-capitalize">Karyawan</p>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <div class="mb-2">
                                                <div class="p-3 pt-2">
                                                    <div class="text pt-1 text-lg-center" >
                                                        <h4 class="mb-3 fs-2">123</h4>
                                                        <p class="text-sm mb-1 text-capitalize ">Total Karyawan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-3">
                                            <div class="mb-2">
                                                <div class="p-3 pt-2" >
                                                    <div class="text pt-1 text-lg-center" >
                                                        <h4 class="mb-3 fs-2">123</h4>
                                                        <p class="text-sm mb-1 text-capitalize ">Tergaji</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-3">
                                            <div class="mb-2">
                                                <div class="p-3 pt-2">
                                                    <div class="text pt-1 text-lg-center">
                                                        <h4 class="mb-3 fs-2">123</h4>
                                                        <p class="text-sm mb-1 text-capitalize ">Terbayar</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>       
            </div>
        </div>
    @endsection
