@php
    $currentRoute = Route::currentRouteName();
@endphp
  <!-- border style class update by aji -->
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius fixed-start    bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://www.umk.ac.id"
            target="_blank">
            <img src="{{ asset('/assets/newimg/umk.ico') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">PT. WIRA WIRI</span>
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'dashboard.index') ? 'active bg-warning' : '' }}"
                    href="{{ url('/') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">home</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
                <!-- update line text karyawan -->
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Karyawan
                </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'user') ? 'active bg-warning' : '' }}"
                    href="{{ route('user.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">groups</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Karyawan</span>
                </a>
            </li>
            <!-- nav integrasi belum ready -->
            <li class="nav-item">
                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'integrate') ? 'active bg-warning' : '' }}"
                    href="{{ url('integrate.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">groups</i>
                    </div>
                    <span class="nav-link-text ms-1">Integrasi</span>
                </a>
            </li>
            <li class="nav-item">
                            <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'departement') ? 'active bg-warning' : '' }}"
                                href="{{ route('departement.index') }}">
                                <span class="material-icons">groups</span>
                                <span class="sidenav-normal  ms-2  ps-1"> Devisi </span>
                            </a>
                        </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'salary.index') ? 'active bg-warning' : '' }}"
                    href="{{ route('salary.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">receipt</i>
                    </div>
                    <span class="nav-link-text ms-1">Keuangan</span>
                </a>
            </li>
                    <!-- diatas ini edit by aji -->
                    <!-- dibawah ini backup code -->
            <div>
                <!-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#dataMaseter"
                        class="nav-link text-white {{ Str::startsWith($currentRoute, ['status', 'grade', 'departement', 'job']) ? 'active' : '' }}"
                        aria-controls="dataMaseter" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">storage</i>
                        <span class="nav-link-text ms-2 ps-1">Master Data</span>
                    </a>
                    <div class="collapse {{ Str::startsWith($currentRoute, ['status', 'grade', 'departement', 'job', 'salarygrade']) ? 'show' : '' }}"
                        id="dataMaseter" style="">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'status') ? 'active bg-warning' : '' }}"
                                    href="{{ route('status.index') }}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Status </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'departement') ? 'active bg-warning' : '' }}"
                                    href="{{ route('departement.index') }}">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Departement </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'job') ? 'active bg-warning' : '' }}"
                                    href="{{ route('job.index') }}">
                                    <span class="sidenav-mini-icon"> J </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Job </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'grade') ? 'active bg-warning' : '' }}"
                                    href="{{ route('grade.index') }}">
                                    <span class="sidenav-mini-icon"> G </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Grade </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'salarygrade') ? 'active bg-warning' : '' }}"
                                    href="{{ route('salarygrade.index') }}">
                                    <span class="sidenav-mini-icon"> <i class="material-icons">price_change</i> </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Salary Data - Per Grade </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Salary Data
                    </h6>
                </li>
                        {{-- 
                <li class="nav-item">
                    <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'salarygrade') ? 'active bg-warning' : '' }}"
                        href="{{ url('/salarygrade') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons">price_change</i>
                        </div>
                        <span class="nav-link-text ms-1">Salary Data - Per Grade</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'salary-year') ? 'active bg-warning' : '' }}"
                        href="{{ url('/salary-year') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons">payments</i>
                        </div>
                        <span class="nav-link-text ms-1">Salary Data - Per Year</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'salary-month') ? 'active bg-warning' : '' }}"
                        href="{{ url('/salary-month') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons">payments</i>
                        </div>
                        <span class="nav-link-text ms-1">Salary Data - Per Month</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'salary.index') ? 'active bg-warning' : '' }}"
                        href="{{ url('/salary') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons">receipt</i>
                        </div>
                        <span class="nav-link-text ms-1">All Salary Data</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link text-danger" href="./sign-in.html">

                        <div class="text-danger text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>

                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </li> -->
            </div>
                    <!-- diatas edit code -->
                    
        </ul>
    </div>

    {{-- <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn btn-danger mt-4 w-100" href="" type="button">Logout</a>
        </div>
    </div> --}}
</aside>
