<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/bridgestone_white.png') }}">

    <title>
        {{ $title }}
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
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js') }}"></script>
</head>

<body class="bg-gray-200">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('assets/img/bskp-company.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center my-2">SI Penggajian</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger text-sm text-white">
                                        Opps! {{ session('error') }}
                                    </div>
                                @endif

                                <form action="{{ route('login.action') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 my-3">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email">
                                            </div>
                                            @error('email')
                                                <small class="text-danger text-sm">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            @error('password')
                                                <small class="text-danger text-sm">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-12 col-md-6 my-auto">
                            <div class="copyright text-center text-sm text-white text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>, Bridgestone Kalimantan Plantation
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.bridgestone.com/" class="nav-link pe-0 text-white"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <p id="real-time-clock" class="nav-link text-white"></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
    <script>
        function updateRealTimeClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var day = now.getDate();
            // var month = now.getMonth() + 1; // Bulan dimulai dari 0, sehingga perlu ditambahkan 1
            var monthAbbreviations = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var month = monthAbbreviations[now.getMonth()];
            var year = now.getFullYear();

            // Format waktu dan tanggal sesuai kebutuhan
            var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes;

            var formattedDate = day + '/' + month + '/' + year;

            // Update elemen HTML dengan waktu dan tanggal terbaru
            document.getElementById('real-time-clock').innerHTML = '[' + formattedTime + ' ' + formattedDate + ']';
        }

        // Pembaruan setiap detik (1000 milidetik)
        setInterval(updateRealTimeClock, 1000);

        // Panggil untuk pertama kali saat halaman dimuat
        updateRealTimeClock();
    </script>
</body>

</html>
