<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-adminassets-path="../adminassets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin</title>

    <meta name="description" content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('adminassets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('adminassets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('adminassets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('adminassets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('adminassets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('adminassets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <script src="{{ asset('adminassets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('adminassets/js/config.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('adminassets/DataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('adminassets/css/styles.css') }}">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <style>
        :root {
            --primary: #3DA50C;
        }

        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        .imgJenis {
            max-width: 100px;
            max-height: 100px;
        }

        table {
            width: 100%;
        }

        .cardContainer {
            text-align: center;
            /* border: 1px solid #ccc; */
            padding: 20px;
            border-radius: 10px;
        }

        #templateCetak {
            display: inline-block;
        }

        #namaCetakAlat {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <p class="display-7 text-primary mb-1"><strong>Logbook FTBio</strong></p>
                            </div>
                            <div class="row">
                                <p class="fs-6">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <li class="menu-item">
                        <a href="{{ route('home') }}" class="menu-link">
                            <div>Daftar Jenis Alat</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('riwayatpinjamhariini') }}" class="menu-link">
                            <div>Pinjam Alat Hari Ini</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('riwayatpinjamsemua') }}" class="menu-link">
                            <div>Semua Peminjaman Alat</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Logout</span></li>
                    <li class="menu-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn menu-link btn-logout">
                                <div>Logout</div>
                            </button>
                        </form>
                    </li>
                </ul>
            </aside>

            <div class="layout-page">
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('adminassets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('adminassets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('adminassets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('adminassets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('adminassets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- DataTables -->
    <script src="{{ asset('adminassets/DataTables/datatables.js') }}"></script>
    <!-- Script  -->
    @yield('script')
</body>

</html>
