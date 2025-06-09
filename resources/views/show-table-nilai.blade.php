<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landing') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('landing') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('landing') }}/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Selecao
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <style>
        #map {
            width: 100%;
            height: 500px;
        }

        .gridjs-wrapper {
            box-shadow: none !important;
            border: none !important;
            border-radius: 0px;
        }

        .gridjs-footer {
            box-shadow: none !important;
            border: none !important;
            padding: 0.5rem !important;
            background-color: #101828;
            font-size: 0.8em !important;
            color: #fff;
            border-radius: 0;
        }

        .gridjs-tr {
            border-radius: 0 !important;
        }

        .gridjs-pagination {
            color: #fff;
        }

        .gridjs-table {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        td.gridjs-td {
            padding: 0.4rem !important;
        }

        .gridjs-tr>th {
            padding: 0.5rem !important;
            background-color: #101828;
            font-size: 0.8em !important;
            color: #fff;
        }

        .gridjs-tr>td {
            padding: 0.5rem !important;
            font-size: 0.8em !important;
        }

        .gridjs-input.gridjs-search-input {
            padding: 0.5rem;
            height: 30px !important;
            border: 1px solid gray;
        }

        .gridjs-pages {
            color: #262626 !important;
        }
    </style>
</head>

<body class="index-page">

    <header class="header d-flex align-items-center fixed-top" id="header">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a class="logo d-flex align-items-center" href="index.html">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img alt="" src="assets/img/logo.png"> -->
                <h1 class="sitename">
                    Sistem Prakerin
                </h1>
            </a>

            <nav class="navmenu" id="navmenu">
                <ul>
                    <li><a class="active" href="{{ url('') }}">Home</a></li>
                    <li><a href="{{ url('login') }}">Login</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">
        <!-- Page Title -->
        <div class="page-title dark-background">
            <div class="container position-relative">
                <h1>Database Data Nilai Siswa</h1>
            </div>
        </div><!-- End Page Title -->
        <div class="container mt-5 mb-5">
            <div id="GridWrapper"></div>
        </div>
    </main>

    <footer class="footer dark-background" id="footer">
        <div class="container">
            <div class="container">
                <div class="copyright">
                    <span>Copyright</span> <strong class="px-1 sitename">Selecao</strong> <span>All Rights
                        Reserved</span>
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you've purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed By <a
                        href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a class="scroll-top d-flex align-items-center justify-content-center" href="#" id="scroll-top"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landing') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('landing') }}/assets/js/main.js"></script>
    <script>
        function getData() {
            try {
                return JSON.parse('{!! $data !!}');
            } catch (error) {
                return [];
            }
        }

        new gridjs.Grid({
            search: true,
            pagination: {
                limit: 10,
                summary: true
            },
            sort: true,
            resizable: true,
            columns: [{
                    name: "No"
                },
                {
                    name: "Nama Dokumen"
                },
                {
                    name: "File"
                },
                {
                    name: "Keterangan"
                },
                {
                    name: "Waktu Upload"
                }
            ],
            data: getData().map((item, index) => [
                index + 1,
                item.nama_dokumen,
                gridjs.html(
                    `<a href="${item.dokument}" target="_blank" class="text-blue-500 underline">Lihat File</a>`
                ),
                item.keterangan ?? '-',
                new Date(item.created_at).toLocaleString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }),
            ])
        }).render(document.getElementById("GridWrapper"));
    </script>

</body>

</html>
