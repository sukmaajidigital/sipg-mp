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
            <img src="/assets/newimg/umk.ico" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">PT. WIRA WIRI</span>
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white ">
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
                    href="">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">groups</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Karyawan</span>
                </a>
            </li>
            <!-- nav integrasi belum ready -->
            <li class="nav-item">
                <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'integrate') ? 'active bg-warning' : '' }}"
                    href="">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">groups</i>
                    </div>
                    <span class="nav-link-text ms-1">Integrasi</span>
                </a>
            </li>
            <li class="nav-item">
                            <a class="nav-link text-white {{ Str::startsWith($currentRoute, 'departement') ? 'active bg-warning' : '' }}"
                                href="">
                                <span class="material-icons">groups</span>
                                <span class="sidenav-normal  ms-2  ps-1"> Devisi </span>
                            </a>
                        </li>
            <li class="nav-item">
                <a class="nav-link text-white "
                    href="">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">receipt</i>
                    </div>
                    <span class="nav-link-text ms-1">Keuangan</span>
                </a>
            </li>
                    
        </ul>
    </div>

</aside>
