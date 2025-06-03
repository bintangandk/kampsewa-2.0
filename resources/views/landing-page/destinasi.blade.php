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
                    <div class="carousel-item active">
                        <img src="{{ asset('template/envato/img/home-4.jpg') }}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">
                                    Rekomendasi</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4">Destinasi Wisata Terbaik untuk
                                    Liburanmu</h1>
                                <p class="mb-5 fs-5">Yuk, cari petualangan seru di destinasi pilihan kami! Dari pantai
                                    keren sampai gunung yang bikin takjub, semua ada di sini.
                                    Setiap tempat dipilih dengan hati-hati biar liburanmu makin berkesan. Ayo jelajahi
                                    tempat-tempat seru dan temukan petualangan baru setiap harinya </p>
                                <div class="d-flex align-items-center justify-content-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
    </div>


    <!-- Packages Start -->
    <div class="container-fluid packages py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Destinasi Pilihan</h5>
                <h1 class="mb-0">Rekomendasi wisata terbaik untuk kamu.</h1>
            </div>
            <div class="packages-carousel owl-carousel">
                <!-- Item 1 - Taman Galaxy -->
                <div class="packages-item d-flex flex-column h-100 border rounded overflow-hidden">
                    <div class="packages-img" style="height: 250px; overflow: hidden;">
                        <img src="{{ asset('template/envato/img/tempat-galaxy.jpg') }}" class="img-fluid w-100 h-100"
                            style="object-fit: cover;" alt="Taman Galaxy">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute w-100 bg-white bg-opacity-75"
                            style="height: 50px; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt me-2 text-primary"></i>Desa Tempurejo
                            </small>
                        </div>
                    </div>
                    <div class="packages-content bg-light flex-grow-1 d-flex flex-column">
                        <div class="p-4 pb-0 flex-grow-1 d-flex flex-column" style="min-height: 250px;">
                            <div>
                                <h5 class="mb-1">Taman Galaxy</h5>
                                <small class="text-uppercase text-muted d-block mb-2">taman dan kebun binatang
                                    mini</small>
                                <div class="mb-3 text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0 flex-grow-1">Jember punya banyak wisata menarik dan lengkap, salah satunya
                                Taman Galaxy yang menyajikan keindahan taman seperti bukit Teletubbies dan kebun
                                binatang.
                            </p>
                        </div>
                        <div class="px-4 py-2 bg-primary text-white">
                            <small>Wisata Keluarga</small>
                        </div>
                    </div>
                </div>

                <!-- Item 2 - Glamping Songgolangit -->
                <div class="packages-item d-flex flex-column h-100 border rounded overflow-hidden">
                    <div class="packages-img" style="height: 250px; overflow: hidden;">
                        <img src="{{ asset('template/envato/img/tempat-glamping.jpg') }}" class="img-fluid w-100 h-100"
                            style="object-fit: cover;" alt="Glamping Songgolangit">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute w-100 bg-white bg-opacity-75"
                            style="height: 50px; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt me-2 text-primary"></i>Kecamatan Dlingo, Bantul
                            </small>
                        </div>
                    </div>
                    <div class="packages-content bg-light flex-grow-1 d-flex flex-column">
                        <div class="p-4 pb-0 flex-grow-1 d-flex flex-column" style="min-height: 250px;">
                            <div>
                                <h5 class="mb-1">Glamping Songgolangit</h5>
                                <small class="text-uppercase text-muted d-block mb-2">Hutan Pinus</small>
                                <div class="mb-3 text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0 flex-grow-1">Fasilitas Seribu Batu Songgo Langit lengkap, mulai dari kasur,
                                kamar mandi pribadi, hingga sofa empuk. Selain berkemah, wisatawan juga bisa mengunjungi
                                spot foto instagrammable.
                            </p>
                        </div>
                        <div class="px-4 py-2 bg-primary text-white">
                            <small>Wisata Alam</small>
                        </div>
                    </div>
                </div>

                <!-- Item 3 - Pantai Tanah Lot -->
                <div class="packages-item d-flex flex-column h-100 border rounded overflow-hidden">
                    <div class="packages-img" style="height: 250px; overflow: hidden;">
                        <img src="{{ asset('template/envato/img/tempat-Bali.jpg') }}" class="img-fluid w-100 h-100"
                            style="object-fit: cover;" alt="Pantai Tanah Lot">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute w-100 bg-white bg-opacity-75"
                            style="height: 50px; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt me-2 text-primary"></i>Kabupaten Tabanan
                            </small>
                        </div>
                    </div>
                    <div class="packages-content bg-light flex-grow-1 d-flex flex-column">
                        <div class="p-4 pb-0 flex-grow-1 d-flex flex-column" style="min-height: 250px;">
                            <div>
                                <h5 class="mb-1">Pantai Tanah Lot</h5>
                                <small class="text-uppercase text-muted d-block mb-2">Pura Terfavorit di Bali</small>
                                <div class="mb-3 text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0 flex-grow-1">Salah satu Pura (Tempat Ibadah Umat Hindu) yang sangat
                                disucikan di Bali,
                                Indonesia. Di sini ada dua Pura yang terletak di atas batu besar. Pura Tanah Lot
                                terkenal sebagai tempat yang indah untuk melihat matahari terbenam.</p>
                        </div>
                        <div class="px-4 py-2 bg-primary text-white">
                            <small>Wisata Religi</small>
                        </div>
                    </div>
                </div>

                <!-- Item 4 - Pantai Green Bowl -->
                <div class="packages-item d-flex flex-column h-100 border rounded overflow-hidden">
                    <div class="packages-img" style="height: 250px; overflow: hidden;">
                        <img src="{{ asset('template/envato/img/tempat-green-bowl.webp') }}"
                            class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Pantai Green Bowl">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute w-100 bg-white bg-opacity-75"
                            style="height: 50px; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt me-2 text-primary"></i>Desa Ungasan
                            </small>
                        </div>
                    </div>
                    <div class="packages-content bg-light flex-grow-1 d-flex flex-column">
                        <div class="p-4 pb-0 flex-grow-1 d-flex flex-column" style="min-height: 250px;">
                            <div>
                                <h5 class="mb-1">Pantai Green Bowl</h5>
                                <small class="text-uppercase text-muted d-block mb-2">Pantai Tersembunyi</small>
                                <div class="mb-3 text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0 flex-grow-1">Lokasinya memang agak susah ditemukan, dan untuk bisa menuju ke
                                pantai
                                ini, kamu harus menuruni ratusan anak tangga yang pastinya akan bikin kaki pegal-pegal
                                saat harus pulang.</p>
                        </div>
                        <div class="px-4 py-2 bg-primary text-white">
                            <small>Wisata Petualangan</small>
                        </div>
                    </div>
                </div>

                <!-- Item 5 - Pantai Kelingking -->
                <div class="packages-item d-flex flex-column h-100 border rounded overflow-hidden">
                    <div class="packages-img" style="height: 250px; overflow: hidden;">
                        <img src="{{ asset('template/envato/img/tempat-kelingking.webp') }}"
                            class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Pantai Kelingking">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute w-100 bg-white bg-opacity-75"
                            style="height: 50px; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt me-2 text-primary"></i>Kabupaten Klungkung
                            </small>
                        </div>
                    </div>
                    <div class="packages-content bg-light flex-grow-1 d-flex flex-column">
                        <div class="p-4 pb-0 flex-grow-1 d-flex flex-column" style="min-height: 250px;">
                            <div>
                                <h5 class="mb-1">Pantai Kelingking</h5>
                                <small class="text-uppercase text-muted d-block mb-2">Pantai dengan Tebing
                                    Indah</small>
                                <div class="mb-3 text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0 flex-grow-1">Tapi tau gak sih, kamu sebenarnya bisa turun mengikuti
                                tangganya yang
                                curam sampai ke pantainya di dasar? Memang masih jarang banget turis yang mau susah
                                payah melakukannya karena memang sangat melelahkan.</p>
                        </div>
                        <div class="px-4 py-2 bg-primary text-white">
                            <small>Wisata Ekstrim</small>
                        </div>
                    </div>
                </div>

                <!-- Item 6 - Taman Nasional Alas Purwo -->
                <div class="packages-item d-flex flex-column h-100 border rounded overflow-hidden">
                    <div class="packages-img" style="height: 250px; overflow: hidden;">
                        <img src="{{ asset('template/envato/img/tempat-purwo.webp') }}" class="img-fluid w-100 h-100"
                            style="object-fit: cover;" alt="Taman Nasional Alas Purwo">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute w-100 bg-white bg-opacity-75"
                            style="height: 50px; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt me-2 text-primary"></i>Banyuwangi
                            </small>
                        </div>
                    </div>
                    <div class="packages-content bg-light flex-grow-1 d-flex flex-column">
                        <div class="p-4 pb-0 flex-grow-1 d-flex flex-column" style="min-height: 250px;">
                            <div>
                                <h5 class="mb-1">Taman Nasional Alas Purwo</h5>
                                <small class="text-uppercase text-muted d-block mb-2">Suaka Margasatwa</small>
                                <div class="mb-3 text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0 flex-grow-1">Taman Nasional Alas Purwo merupakan kawasan konservasi yang
                                terletak di
                                ujung timur Pulau Jawa. Secara administratif, Alas Purwo masuk wilayah Kecamatan
                                Tegaldlimo dan Kecamatan Purwoharjo, Kabupaten Banyuwangi, Jawa Timur.</p>
                        </div>
                        <div class="px-4 py-2 bg-primary text-white">
                            <small>Wisata Konservasi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Packages End -->
    <!-- Destination Start -->
    <div class="container-fluid destination py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Jelajahi wisatamu sekarang</h5>
                <h1 class="mb-0">Lihat pilihan wisata didekat mu</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active"
                            data-bs-toggle="pill" href="#tab-1">
                            <span class="text-dark" style="width: 150px;">Jawa Timur</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                            href="#tab-2">
                            <span class="text-dark" style="width: 150px;">Jawa Tengah</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                            href="#tab-3">
                            <span class="text-dark" style="width: 150px;">Jawa Barat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                            href="#tab-4">
                            <span class="text-dark" style="width: 150px;">Bali</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                            href="#tab-5">
                            <span class="text-dark" style="width: 150px;">Sumatra</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                            href="#tab-6">
                            <span class="text-dark" style="width: 150px;">Sulawesi</span>
                        </a>
                    </li>
                </ul>
                <!-- Jawa Timur-->
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-xl-8">
                                <div class="row g-4">
                                    <!-- Item 1 - Pantai Papuma -->
                                    <div class="col-lg-6">
                                        <div class="destination-img" style="height: 300px; overflow: hidden;">
                                            <img class="img-fluid w-100 h-100 rounded"
                                                src="{{ asset('template/envato/img/tempat-papuma.png') }}"
                                                style="object-fit: cover;" alt="Pantai Papuma">
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">Pantai Papuma</h4>
                                                <a href="#" class="btn-hover text-white">Kunjungi<i
                                                        class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="img/destination-1.jpg" data-lightbox="destination-1">
                                                    <i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 2 - Pantai Payangan -->
                                    <div class="col-lg-6">
                                        <div class="destination-img" style="height: 300px; overflow: hidden;">
                                            <img class="img-fluid w-100 h-100 rounded"
                                                src="{{ asset('template/envato/img/tempat-teluk-love.jpg') }}"
                                                style="object-fit: cover;" alt="Pantai Payangan">
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">Pantai Payangan</h4>
                                                <a href="#" class="btn-hover text-white">Kunjungi<i
                                                        class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="img/destination-2.jpg" data-lightbox="destination-2">
                                                    <i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 3 - Puncak Rembangan -->
                                    <div class="col-lg-6">
                                        <div class="destination-img" style="height: 300px; overflow: hidden;">
                                            <img class="img-fluid w-100 h-100 rounded"
                                                src="{{ asset('template/envato/img/tempat-rembangan.jpg') }}"
                                                style="object-fit: cover;" alt="Puncak Rembangan">
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">Puncak Rembangan</h4>
                                                <a href="#" class="btn-hover text-white">Kunjungi<i
                                                        class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="img/destination-7.jpg" data-lightbox="destination-7">
                                                    <i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 4 - Taman Galaxy -->
                                    <div class="col-lg-6">
                                        <div class="destination-img" style="height: 300px; overflow: hidden;">
                                            <img class="img-fluid w-100 h-100 rounded"
                                                src="{{ asset('template/envato/img/tempat-galaxy.jpg') }}"
                                                style="object-fit: cover;" alt="Taman Galaxy">
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">Taman Galaxy</h4>
                                                <a href="#" class="btn-hover text-white">kunjungi<i
                                                        class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="img/destination-8.jpg" data-lightbox="destination-8">
                                                    <i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 5 - Gunung Gambir -->
                            <div class="col-xl-4">
                                <div class="destination-img" style="height: 630px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-gunung-gambir.jpg') }}"
                                        style="object-fit: cover;" alt="Gunung Gambir">
                                    <div class="destination-overlay p-4">
                                        <h4 class="text-white mb-2 mt-3">Gunung Gambir</h4>
                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>
                                    <div class="search-icon">
                                        <a href="img/destination-9.jpg" data-lightbox="destination-4">
                                            <i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 6 - Taman Nasional Baluran -->
                            <div class="col-lg-4">
                                <div class="destination-img" style="height: 300px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-taman-nasional-baluran.jpeg') }}"
                                        style="object-fit: cover;" alt="Taman Nasional Baluran">
                                    <div class="destination-overlay p-4">
                                        <h4 class="text-white mb-2 mt-3">Taman Nasional Baluran</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>
                                    <div class="search-icon">
                                        <a href="img/destination-4.jpg" data-lightbox="destination-4">
                                            <i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 7 - Alas Purwo -->
                            <div class="col-lg-4">
                                <div class="destination-img" style="height: 300px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-purwo.webp') }}"
                                        style="object-fit: cover;" alt="Alas Purwo">
                                    <div class="destination-overlay p-4">
                                        <h4 class="text-white mb-2 mt-3">Alas Purwo</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>

                            <!-- Item 8 - Gunung Pasang -->
                            <div class="col-lg-4">
                                <div class="destination-img" style="height: 300px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-gunung-pasang.jpg') }}"
                                        style="object-fit: cover;" alt="Gunung Pasang">
                                    <div class="destination-overlay p-4">
                                        <h4 class="text-white mb-2 mt-3">Gunung Pasang</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- jawa tengah -->
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <!-- Item 1 - Sunrise Camp Gunung Prau -->
                            <div class="col-lg-4">
                                <div class="destination-img" style="height: 300px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-prau.webp') }}"
                                        style="object-fit: cover;" alt="Sunrise Camp Gunung Prau">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Sunrise Camp Gunung Prau</h4>
                                        <a href="#" class="btn-hover text-white">Kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>

                            <!-- Item 2 - Camp Area Umbul Bengkok -->
                            <div class="col-lg-4">
                                <div class="destination-img" style="height: 300px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-umbul.jpg') }}"
                                        style="object-fit: cover;" alt="Camp Area Umbul Bengkok">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Camp Area Umbul Bengkok</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>

                            <!-- Item 3 - Wana Wisata Hutan Pinus Nglimut -->
                            <div class="col-lg-4">
                                <div class="destination-img" style="height: 300px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-nglimut.webp') }}"
                                        style="object-fit: cover;" alt="Wana Wisata Hutan Pinus Nglimut">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Wana Wisata Hutan Pinus Nglimut</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>

                            <!-- Item 4 - Telaga Dringo -->
                            <div class="col-lg-4">
                                <div class="destination-img" style="height: 300px; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-dringo.jpg') }}"
                                        style="object-fit: cover;" alt="Telaga Dringo">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Telaga Dringo</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- jawa barat -->
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img class="img-fluid w-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-batu-karas.jpeg') }}"
                                        alt="Destinasi Wisata">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Pantai Batu Karas</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img class="img-fluid w-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-gua.jpeg') }}"
                                        alt="Destinasi Wisata">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Gua Sunyaragi</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img class="img-fluid w-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-ranca.webp') }}"
                                        alt="Destinasi Wisata">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Ranca Upas</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img class="img-fluid w-100 rounded"
                                        src="{{ asset('template/envato/img/tempat-dago.webp') }}"
                                        alt="Destinasi Wisata">
                                    <div class="destination-overlay p-4">

                                        <h4 class="text-white mb-2 mt-3">Dago Dream Park</h4>
                                        <a href="#" class="btn-hover text-white">kunjungi<i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bali -->
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <!-- Gambar 1 - Banyumala Twin Waterfall -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-banyumala.jpg') }}"
                                        alt="Banyumala Twin Waterfall"
                                        style="object-fit: cover; object-position: center;">

                                    <!-- Overlay Konten -->
                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Banyumala Twin Waterfall</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>

                                    <!-- Icon Search -->

                                </div>
                            </div>

                            <!-- Gambar 2 - Campuhan Ridge Walk -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-campuhan.jpeg') }}"
                                        alt="Campuhan Ridge Walk" style="object-fit: cover; object-position: center;">

                                    <!-- Overlay Konten -->
                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Campuhan Ridge Walk</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>

                                    <!-- Icon Search -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sumatra -->
                    <div id="tab-5" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <!-- Danau Ranau -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-ranau.webp') }}" alt="Danau Ranau"
                                        style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Danau Ranau</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Bukit Khayangan -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-khayangan.webp') }}"
                                        alt="Bukit Khayangan" style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Bukit Khayangan</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Lembah Harau -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-lembah-harau.webp') }}"
                                        alt="Lembah Harau" style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Lembah Harau</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Danau Maninjau -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-maninjau.webp') }}"
                                        alt="Danau Maninjau" style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Danau Maninjau</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sulawesi -->
                    <div id="tab-6" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <!-- Pantai Samalona -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-samalona.webp') }}"
                                        alt="Pantai Samalona" style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Pantai Samalona</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>

                                    <div class="search-icon position-absolute top-0 end-0 m-3">
                                        <a href="{{ asset('template/envato/img/tempat-samalona.webp') }}"
                                            data-lightbox="beach-gallery">
                                            <i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-sm-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Pantai Tanjung Bira -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-tanjung-bira.webp') }}"
                                        alt="Pantai Tanjung Bira" style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Pantai Tanjung Bira</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>

                                    <div class="search-icon position-absolute top-0 end-0 m-3">
                                        <a href="{{ asset('template/envato/img/tempat-tanjung-bira.webp') }}"
                                            data-lightbox="beach-gallery">
                                            <i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-sm-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Pulau Kapoposang -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-kepoposang.webp') }}"
                                        alt="Pulau Kapoposang" style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Pulau Kapoposang</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>

                                    <div class="search-icon position-absolute top-0 end-0 m-3">
                                        <a href="{{ asset('template/envato/img/tempat-kepoposang.webp') }}"
                                            data-lightbox="beach-gallery">
                                            <i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-sm-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Pulau Cangke -->
                            <div class="col-lg-6">
                                <div
                                    class="destination-img ratio ratio-16x9 position-relative overflow-hidden rounded">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ asset('template/envato/img/tempat-cangke.webp') }}"
                                        alt="Pulau Cangke" style="object-fit: cover; object-position: center;">

                                    <div
                                        class="destination-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                        <h4 class="text-white mb-2">Pulau Cangke</h4>
                                        <a href="#" class="btn-hover text-white align-self-start">
                                            Kunjungi <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>

                                    <div class="search-icon position-absolute top-0 end-0 m-3">
                                        <a href="{{ asset('template/envato/img/tempat-cangke.webp') }}"
                                            data-lightbox="beach-gallery">
                                            <i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-sm-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Destination End -->




















    @include('landing-page.halamanbawah')

    @include('landing-page.footer')
