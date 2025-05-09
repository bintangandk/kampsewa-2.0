@include('landing-page.header')


<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->

    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">

        @include('landing-page.navbar')


        <!-- Carousel Start -->
        <div class="carousel-header">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <img src="{{ asset('template/envato/img/home-1.jpg') }}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px; text-align: left;">
                                <h4 class="text-white text-uppercase fw-bold mb-4"
                                    style="letter-spacing: 3px; margin-left: 10px; font-size: 1.5rem;">KampSewa</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4"
                                    style="margin-left: 10px; font-size: 2.5rem; font-weight: normal;">Solusi Lengkap
                                    untuk Kebutuhan Sewa mu!</h1>
                                <p class="mb-5 fs-5" style="margin-left: 10px; font-size: 1rem; font-weight: normal;">
                                    Unduh aplikasi KampSewa sekarang dan rasakan kemudahan serta kenyamanan dalam
                                    memenuhi segala kebutuhan sewa mu.</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5"
                                        href="#">Unduh Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <img src="{{ asset('template/envato/img/home-2.jpg') }}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px; text-align: right;">
                                <h4 class="text-white text-uppercase fw-bold mb-4"
                                    style="letter-spacing: 3px; margin-right: 10px; font-size: 1.5rem;">KampSewa</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4"
                                    style="margin-right: 10px; font-size: 2.5rem; font-weight: normal;">Temukan Beragam
                                    Pilihan Sewa</h1>
                                <p class="mb-5 fs-5" style="margin-right: 10px; font-size: 1rem; font-weight: normal;">
                                    Temukan barang yang Kamu inginkan dengan mudah melalui sistem pencarian canggih dan
                                    kategori yang terorganisir.</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5"
                                        href="#">Unduh Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <img src="{{ asset('template/envato/img/home-3.jpg') }}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px; text-align: center;">
                                <h4 class="text-white text-uppercase fw-bold mb-4"
                                    style="letter-spacing: 3px; font-size: 1.5rem;">KampSewa</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4"
                                    style="font-size: 2.5rem; font-weight: normal;">Sewa Apa Saja, Kapan Saja, Di Mana
                                    Saja</h1>
                                <p class="mb-5 fs-5" style="font-size: 1rem; font-weight: normal;">Akses KampSewa kapan
                                    pun dan di mana pun Kamu berada, melalui aplikasi mobile yang praktis dan mudah
                                    digunakan.</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5"
                                        href="#">Unduh Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->
    </div>

    <!-- Navbar & Hero End -->

    <!-- About Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="h-100"
                        style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                        <img src="template/envato/img/about-kamp.jpg" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
                <div class="col-lg-7"
                    style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                    <h5 class="section-about-title pe-3">Tentang Kami</h5>
                    <h1 class="mb-4">Kamp<span class="text-primary">Sewa</span></h1>
                    <p class="mb-4">Di KampSewa, kami bikin hidup petualang jadi lebih simpel! Apapun level
                        petualanganmu, dari yang baru mulai sampe yang udah jadi master, kami siap bantu kamu! Sewa
                        peralatan camping berkualitas tinggi dengan mudah, tanpa ribet, dan tentunya hemat biaya.</p>
                    <p class="mb-4">Nggak perlu repot-repot beli dan simpan peralatan sendiri. Lewat platform
                        KampSewa, kamu bisa nyambung sama vendor-vendor keren yang tepercaya. Mulai dari tenda sampe
                        perlengkapan outdoor lainnya, semua lengkap ada di sini!.</p>
                    <p class="mb-4">Langsung aja unduh aplikasi kami sekarang juga! Petualangan baru tinggal di ujung
                        jari. Butuh bantuan atau info lebih lanjut? Tim dukungan kami siap sedia, jadi jangan ragu untuk
                        kontak kami!</p>
                    <p class="mb-4 fs-5 fw-bold">Layanan Kami:</p>
                    <div class="row gy-2 gx-3 mb-3">
                        <div class="col-sm-6">
                            <p class="mb-0 service-item"><i class="fa fa-check-circle text-success me-2"></i>Pilihan
                                Lengkap</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0 service-item"><i class="fa fa-check-circle text-success me-2"></i>Jaminan
                                Kualitas</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0 service-item"><i class="fa fa-check-circle text-success me-2"></i>Opsi Sewa
                                Fleksibel</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0 service-item"><i
                                    class="fa fa-check-circle text-success me-2"></i>Pengiriman & Pengambilan yang
                                Mudah</p>
                        </div>
                    </div>

                </div>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
    </div>
    <!-- About End -->

    <!-- Services Start -->
    <div class="container-fluid bg-light service py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Keunggulan kami</h5>
                <h1 class="mb-0">Kenapa Harus Pilih KampSewa?</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-recycle fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Bebas Limbah</h5>
                                    <p class="mb-0">Bantu jaga alam dengan menyewa peralatan, tanpa bikin sampah dan
                                        lebih berkelanjutan!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-money-bill-wave fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Hemat Biaya</h5>
                                    <p class="mb-0">Cukup sewa! Hemat duitmu dan tetap bisa nikmati petualangan tanpa
                                        keluar banyak uang.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-search-dollar fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Coba Dulu, Beli Nanti</h5>
                                    <p class="mb-0">Nggak usah nekat beli! Di sini bisa nyoba dulu sebelum memutuskan
                                        beli, biar gak nyesel!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-users fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Komunitas Pecinta Alam</h5>
                                    <p class="mb-0">Bergabung dengan komunitas seru kami, bagi cerita, temenan, dan
                                        cari partner buat petualanganmu!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-shipping-fast fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Pengiriman Mudah</h5>
                                    <p class="mb-0">Gak perlu khawatir soal pengiriman dan pengambilan. Kami siap
                                        antar langsung ke lokasimu!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-campground fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Lengkap dan Praktis</h5>
                                    <p class="mb-0">Semua peralatan camping yang kamu butuhkan lengkap ada di sini!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Services End -->



                <!-- Explore Tour Start -->
                <div class="container-fluid ExploreTour py-5">
                    <div class="container py-5">
                        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                            <h5 class="section-title px-3">Destinasi Wisata</h5>
                            <h1 class="mb-4">Rekomendasi tempat wisata</h1>
                            <p class="mb-0">Beberapa rekomendasi tempat wisata yang cocok untuk kamu kunjungi
                            </p>
                        </div>
                        <div class="tab-class text-center">
                            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active"
                                        data-bs-toggle="pill" href="#NationalTab-1">
                                        <span class="text-dark" style="width: 250px;">Terpopuler</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill"
                                        data-bs-toggle="pill" href="#InternationalTab-2">
                                        <span class="text-dark" style="width: 250px;">Terbaik</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- populer -->
                            <div class="tab-content">
                                <div id="NationalTab-1" class="tab-pane fade show p-0 active">
                                    <div class="row g-4">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-glamping.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Glamping
                                                            Songgolangit</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-pandawa.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Pantai Pandawa</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-gunung-gambir.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Gunung Gambir</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-gunung-pasang.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Gunung Pasang</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-rembangan.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Kawasan Puncak
                                                            Rembangan</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-manggisan.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Air Terjun Manggisan
                                                        </h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-taman-nasional-baluran.jpeg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Taman Nasional
                                                            Baluran</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-tumpak-sewu.webp') }}"
                                                    class="img-fluid w-100 rounded" alt="Image"
                                                    style="height: 300px;">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Tumpak Sewu</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-gili-noko.webp') }}"
                                                    class="img-fluid w-100 rounded" alt="Image"
                                                    style="height: 300px">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Gili dan Noko</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-lombok.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image"
                                                    style="height: 100%;">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Lombok</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-galaxy.jpg') }}"
                                                    class="img-fluid w-100 rounded" alt="Image">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Taman Galaxy</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="national-item">
                                                <img src="{{ asset('template/envato/img/tempat-tumpak-sewu.webp') }}"
                                                    class="img-fluid w-100 rounded" alt="Image"
                                                    style="height: 300px;">
                                                <div class="national-content">
                                                    <div class="national-info">
                                                        <h5 class="text-white text-uppercase mb-2">Air Terjun Tumpak
                                                            Sewu</h5>
                                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                                class="fa fa-arrow-right ms-2"></i></a>
                                                    </div>
                                                </div>
                                                <div class="national-plus-icon">
                                                    <a href="#" class="my-auto"><i
                                                            class="fas fa-link fa-2x text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <!-- Terbaik -->
                                <div id="InternationalTab-2" class="tab-pane fade show p-0">
                                    <div class="InternationalTour-carousel owl-carousel">
                                        <div class="international-item">
                                            <img src="{{ asset('template/envato/img/tempat-papuma.png') }}"
                                                class="img-fluid w-100 rounded" alt="Image">
                                            <div class="international-content">
                                                <div class="international-info">
                                                    <h5 class="text-white text-uppercase mb-2">Pantai Papuma</h5>
                                                    <a href="#" class="btn-hover text-white me-4"><i
                                                            class="fas fa-map-marker-alt me-1"></i>26 km</a>
                                                    <a href="#" class="btn-hover text-white"><i
                                                            class="fa fa-eye ms-2"></i> <span>1220 kunjungan</span></a>
                                                </div>
                                            </div>
                                            <div class="international-plus-icon">
                                                <a href="#" class="my-auto"><i
                                                        class="fas fa-link fa-2x text-white"></i></a>
                                            </div>
                                        </div>
                                        <div class="international-item">
                                            <img src="{{ asset('template/envato/img/tempat-taman-nasional-baluran.jpeg') }}"
                                                class="img-fluid w-100 rounded" alt="Image">
                                            <div class="international-content">
                                                <div class="international-info">
                                                    <h5 class="text-white text-uppercase mb-2">Taman Nasional Baluran
                                                    </h5>
                                                    <a href="#" class="btn-hover text-white me-4"><i
                                                            class="fas fa-map-marker-alt me-1"></i>32 km</a>
                                                    <a href="#" class="btn-hover text-white"><i
                                                            class="fa fa-eye ms-2"></i> <span>3210 Kunjungan</span></a>
                                                </div>
                                            </div>
                                            <div class="international-plus-icon">
                                                <a href="#" class="my-auto"><i
                                                        class="fas fa-link fa-2x text-white"></i></a>
                                            </div>
                                        </div>
                                        <div class="international-item">
                                            <img src="{{ asset('template/envato/img/tempat-galaxy.jpg') }}"
                                                class="img-fluid w-100 rounded" alt="Image">
                                            <div class="international-content">

                                                <div class="international-info">
                                                    <h5 class="text-white text-uppercase mb-2">Taman Galaxy</h5>
                                                    <a href="#" class="btn-hover text-white me-4"><i
                                                            class="fas fa-map-marker-alt me-1"></i>45 km</a>
                                                    <a href="#" class="btn-hover text-white"><i
                                                            class="fa fa-eye ms-2"></i> <span>123 Kunjungan</span></a>
                                                </div>
                                            </div>
                                            <div class="international-plus-icon">
                                                <a href="#" class="my-auto"><i
                                                        class="fas fa-link fa-2x text-white"></i></a>
                                            </div>
                                        </div>
                                        <div class="international-item">
                                            <img src="{{ asset('template/envato/img/tempat-manggisan.jpg') }}"
                                                class="img-fluid w-100 rounded" alt="Image">
                                            <div class="international-content">
                                                <div class="international-info">
                                                    <h5 class="text-white text-uppercase mb-2">Air Terjun Manggisan
                                                    </h5>
                                                    <a href="#" class="btn-hover text-white me-4"><i
                                                            class="fas fa-map-marker-alt me-1"></i>34 km</a>
                                                    <a href="#" class="btn-hover text-white"><i
                                                            class="fa fa-eye ms-2"></i> <span>120 Kunjungan</span></a>
                                                </div>
                                            </div>
                                            <div class="international-plus-icon">
                                                <a href="#" class="my-auto"><i
                                                        class="fas fa-link fa-2x text-white"></i></a>
                                            </div>
                                        </div>
                                        <div class="international-item">
                                            <img src="{{ asset('template/envato/img/tempat-lombok.jpg') }}"
                                                class="img-fluid w-100 rounded" alt="Image">
                                            <div class="international-content">

                                                <div class="international-info">
                                                    <h5 class="text-white text-uppercase mb-2">Lombok</h5>
                                                    <a href="#" class="btn-hover text-white me-4"><i
                                                            class="fas fa-map-marker-alt me-1"></i>36 km</a>
                                                    <a href="#" class="btn-hover text-white"><i
                                                            class="fa fa-eye ms-2"></i> <span>340 Kunjungan</span></a>
                                                </div>
                                            </div>
                                            <div class="international-plus-icon">
                                                <a href="#" class="my-auto"><i
                                                        class="fas fa-link fa-2x text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Explore Tour Start -->



                <!-- Gallery Start -->

                <!-- Gallery End -->

                <!-- Tour Booking Start -->

                <!-- Tour Booking End -->

                <!-- Travel Guide Start -->
                <div class="container-fluid guide py-5">
                    <div class="container py-5">
                        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                            <h5 class="section-title px-3">Terpopuler Minggu Ini</h5>
                            <h1 class="mb-0">Rekomendasi Toko</h1>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-rei.jpg') }}"
                                                class="img-fluid w-100 rounded-top" alt="Image">
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">Rei Outdoor Gear</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-eiger.jpeg') }}"
                                                class="img-fluid w-100 rounded-top" alt="Image">
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">Eiger Adventure</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-consina.png') }}"
                                                class="img-fluid w-100 rounded-top" alt="Image">
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">Consina</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-tnf.jpg') }}"
                                                class="img-fluid w-100 rounded-top" alt="Image">
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">The North Face</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-deca.jpg') }}"
                                                class="img-fluid w-100 rounded-top" alt="Image"" >
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">Decathlon.ID</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-deuter.webp') }}"
                                                class="img-fluid w-100 rounded-top custom-img-height" alt="Image"> 
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">Deuter Store</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-avtech.jpg') }}"
                                                class="img-fluid w-100 rounded-top" alt="Image" >
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">Avtech store</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="guide-item">
                                    <div class="guide-img">
                                        <div class="guide-img-efects">
                                            <img src="{{ asset('template/envato/img/toko-jack.jpg') }}"
                                                class="img-fluid w-100 rounded-top" alt="Image">
                                        </div>
                                        <div class="guide-icon rounded-pill p-2">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-instagram"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1"
                                                href=""><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="guide-title text-center rounded-bottom p-4">
                                        <div class="guide-title-inner">
                                            <h4 class="mt-3">Jack Wolfskin</h4>
                                            <p class="mb-0">Terlaris Minggu ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Travel Guide End -->

                <!-- Blog Start -->

                <!-- Blog End -->

                <!-- Testimonial Start -->

                <!-- Testimonial End -->

                <!-- Subscribe Start -->

                <!-- Subscribe End -->

                <!-- Footer Start -->


                @include('landing-page.halamanbawah')


                <!-- JavaScript Libraries -->

                @include('landing-page.footer')
