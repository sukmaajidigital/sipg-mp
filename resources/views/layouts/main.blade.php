<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/newimg/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/newimg/umk.ico') }}">

    <title>
        MP - JUDUL
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Datatable CSS -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />

    <!-- Datatable CSS -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" />

    <!-- Select2 CSS -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" />

    <!-- Bootsrap 5.3.2 CSS -->
    {{-- <link href="{{ asset('assets/libs/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet" /> --}}

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <style>
        .small-tbl th,
        td {
            width: auto;
            border: 1px solid #ddd;
            white-space: normal;
            word-wrap: break-word;
            font-size: 10pt;
            font-family: 'Arial', sans-serif
        }

        .bg-thead {
            background-color: #1A73E8;
            color: white;
        }
    </style>
</head>


<body class="g-sidenav-show bg-gray-100">
    @include('layouts/menu')

    <main class="main-content border-radius-lg ">
        <!-- Navbar -->

        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <!-- update nav sidebar by aji-->
                        <li class="nav-item d-xl-none px-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="{{ url('/') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">JUDUL
                        </li>
                    </ol>
                    <h1 class="font-weight-bolder mt-5 fs-2">JUDUL</h1>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                        {{-- <div class="input-group input-group-outline">
                            <label class="form-label">Type here...</label>
                            <input type="text" class="form-control">
                        </div> --}}

                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <!-- location before navbar update -->
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            {{-- <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a> --}}
                            <a href="./pages/sign-in.html" class="nav-link text-body p-0 font-weight-bold"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign In</span>
                            </a>

                            <ul class="dropdown-menu  dropdown-menu-end  px-2 " aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex text-primary">
                                            <div class="pe-2">
                                                <i class="material-icons opacity-10">logout</i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal">
                                                    <span class="font-weight-bold text-danger">Logout</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item d-flex align-items-center">
                            <a href="./pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign In</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">

            @yield('content')

            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>, PT Wira Wiri
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{-- <div id="real-time-clock"></div> --}}
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <!-- <li class="nav-item">
                                    <a href="https://www.bridgestone.com/" class="nav-link pe-0 text-muted"
                                        target="_blank">About Us</a>
                                </li> -->
                                {{-- <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li> --}}
                                <li class="nav-item">
                                    <p id="real-time-clock" class="nav-link text-muted"></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </main>

    <!-- Jquery JS-->
    <script src="{{ asset('assets/libs/jquery/jquery.js') }}"></script>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- Datatable JS-->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>

    <!-- JQuery Validation JS -->
    <script src="{{ asset('assets/libs/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src=" {{ asset('assets/libs/jquery-validation/additional-methods.min.js') }}"></script>

    {{-- Select2 JS --}}
    <script src=" {{ asset('assets/libs/select2/js/select2.min.js') }}"></script>


    <!-- InputMask -->
    <script src="{{ asset('assets/libs/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4"></script>

    @include('layouts/script')

</body>

</html>
