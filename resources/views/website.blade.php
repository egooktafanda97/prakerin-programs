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
    <style>
        #map {
            width: 100%;
            height: 500px;
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

        <!-- Hero Section -->
        <section class="hero section dark-background" id="hero">

            <div class="container carousel carousel-fade" data-bs-interval="5000" data-bs-ride="carousel"
                id="hero-carousel">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="carousel-container">
                        <h2 class="animate__animated animate__fadeInDown">Welcome to Sistem Informasi
                            Perakerin</h2>
                        <p class="animate__animated animate__fadeInUp">
                            Sistem Informasi Perakerin adalah platform yang dirancang untuk memfasilitasi
                            proses Praktek Kerja Industri (Prakerin) bagi siswa, sekolah, dan perusahaan.
                            Dengan fitur-fitur yang lengkap, sistem ini membantu dalam manajemen penempatan,
                            penilaian, dan pelaporan kegiatan Prakerin secara efisien dan terstruktur.
                        </p>
                        <a class="btn-get-started animate__animated animate__fadeInUp scrollto"
                            href="{{ url('tabel-nilai-siswa') }}">
                            Data Penilaian Siswa
                        </a>
                    </div>
                </div>

                <a class="carousel-control-prev" data-bs-slide="prev" href="#hero-carousel" role="button">
                    <span aria-hidden="true" class="carousel-control-prev-icon bi bi-chevron-left"></span>
                </a>

                <a class="carousel-control-next" data-bs-slide="next" href="#hero-carousel" role="button">
                    <span aria-hidden="true" class="carousel-control-next-icon bi bi-chevron-right"></span>
                </a>

            </div>

            <svg class="hero-waves" preserveAspectRatio="none" viewBox="0 24 150 28 "
                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <path d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" id="wave-path">
                    </path>
                </defs>
                <g class="wave1">
                    <use x="50" xlink:href="#wave-path" y="3"></use>
                </g>
                <g class="wave2">
                    <use x="50" xlink:href="#wave-path" y="0"></use>
                </g>
                <g class="wave3">
                    <use x="50" xlink:href="#wave-path" y="9"></use>
                </g>
            </svg>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section class="about section" id="about">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang</h2>
                <p>Who we are</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 content" data-aos-delay="100" data-aos="fade-up">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam doloremque, at, debitis
                        eveniet explicabo repudiandae molestiae fuga animi illum ea numquam cum delectus aperiam
                        possimus nisi impedit sit. Hic, totam.
                    </div>
                    <div class="col-lg-6" data-aos-delay="200" data-aos="fade-up">
                        <div id="map"></div>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->



        <!-- Contact Section -->
        <section class="contact section" id="contact">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>Contact Us</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos-delay="100" data-aos="fade">

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos-delay="200" data-aos="fade-up">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos-delay="300" data-aos="fade-up">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos-delay="400" data-aos="fade-up">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>info@example.com</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                    <div class="col-lg-8">
                        <form action="forms/contact.php" class="php-email-form" data-aos-delay="200"
                            data-aos="fade-up" method="post">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input class="form-control" name="name" placeholder="Your Name"
                                        required="" type="text">
                                </div>

                                <div class="col-md-6 ">
                                    <input class="form-control" name="email" placeholder="Your Email"
                                        required="" type="email">
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" name="subject" placeholder="Subject" required=""
                                        type="text">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" placeholder="Message" required="" rows="6"></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->




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

    <!-- Main JS File -->
    <script src="{{ asset('landing') }}/assets/js/main.js"></script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXRQDtcZ55EQ_2hVJFwAb1Vd9kEPyJGmY"
        type="text/javascript"></script>
    <script>
        function getData() {
            try {
                const rawData = {!! $perusahaan !!}; // Sudah dalam bentuk array JS dari controller
                return rawData.map(item => {
                    const [latStr, lngStr] = item.koordinat.split(',');
                    return {
                        position: {
                            lat: parseFloat(latStr),
                            lng: parseFloat(lngStr)
                        },
                        title: item.nama_perusahaan,
                        info: `${item.nama_perusahaan}<br>${item.alamat}<br>${item.no_hp}<br>Bidang: ${item.bidang_usaha}`
                    };
                });
            } catch (error) {
                console.error("Error parsing data:", error);
                return [];
            }
        }

        let map; // Variabel global untuk objek peta

        // Fungsi untuk menginisialisasi peta
        function initMap() {
            console.log("initMap() dipanggil. Mencoba menginisialisasi peta...");

            // Pastikan elemen #map ada sebelum mencoba membuat peta
            const mapElement = document.getElementById('map');
            if (!mapElement) {
                console.error("Elemen dengan ID 'map' tidak ditemukan di DOM.");
                return; // Hentikan eksekusi jika elemen tidak ada
            }

            // Koordinat pusat peta (contoh: Jakarta),
            const centerLocation = {
                lat: 0.2971720522360002,
                lng: 102.27441055239692
            };

            // Opsi peta
            const mapOptions = {
                zoom: 12, // Level zoom awal
                center: centerLocation, // Pusat peta
                mapTypeId: 'roadmap', // Tipe peta (roadmap, satellite, hybrid, terrain)
                fullscreenControl: true, // Kontrol fullscreen
                zoomControl: true, // Kontrol zoom
                streetViewControl: false, // Kontrol Street View
                mapTypeControl: false, // Kontrol tipe peta
            };

            try {
                // Membuat objek peta baru dan menempatkannya di div dengan id 'map'
                map = new google.maps.Map(mapElement, mapOptions);
                console.log("Peta berhasil diinisialisasi.");
                console.log("Koordinat pusat peta:", getData());

                // Daftar marker yang akan ditambahkan
                const markersData = getData();

                // Menambahkan marker ke peta
                markersData.forEach(markerInfo => {
                    const marker = new google.maps.Marker({
                        position: markerInfo.position,
                        map: map,
                        title: markerInfo.title,
                        animation: google.maps.Animation.DROP // Efek animasi saat marker muncul
                    });

                    // Membuat jendela informasi (InfoWindow) untuk setiap marker
                    const infoWindow = new google.maps.InfoWindow({
                        content: `<strong>${markerInfo.title}</strong><br>${markerInfo.info}`
                    });

                    // Menambahkan event listener agar InfoWindow muncul saat marker diklik
                    marker.addListener('click', () => {
                        infoWindow.open(map, marker);
                    });
                });
                console.log(`${markersData.length} marker ditambahkan ke peta.`);

                // Menyesuaikan ukuran peta saat ukuran jendela berubah
                google.maps.event.addDomListener(window, 'resize', () => {
                    const center = map.getCenter();
                    google.maps.event.trigger(map, 'resize');
                    map.setCenter(center);
                });

            } catch (error) {
                console.error("Gagal menginisialisasi peta Google Maps:", error);
                console.error(
                    "Pastikan Anda memiliki koneksi internet, API Key yang valid, dan Maps JavaScript API diaktifkan di Google Cloud Console."
                );
            }
        }

        // Memuat Google Maps API secara asinkron
        // GANTI 'YOUR_GOOGLE_MAPS_API_KEY' dengan API Key Anda yang sebenarnya
        // Pastikan Maps JavaScript API sudah diaktifkan di Google Cloud Console Anda
        const script = document.createElement('script');
        // Gunakan API Key yang Anda berikan. Periksa kembali validitas dan pembatasannya.
        script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyCXRQDtcZ55EQ_2hVJFwAb1Vd9kEPyJGmY&callback=initMap`;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);

        // Tambahkan event listener untuk memastikan script dimuat
        script.onload = () => {
            console.log("Google Maps API script berhasil dimuat.");
        };
        script.onerror = (e) => {
            console.error("Gagal memuat Google Maps API script:", e);
            console.error("Pastikan URL API Key benar dan tidak ada masalah jaringan/CSP.");
        };
    </script>

</body>

</html>
