<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="#" class="navbar-brand p-0">
        <h1 class="m-0">
            <img src="{{asset('template/envato/img/logog-kampsewa.png')}}" alt="KampSewa" sizes="">KampSewa</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('landing-page.halaman-beranda') }}" class="nav-item nav-link {{ Request::routeIs('landing-page.halaman-beranda') ? 'active' : '' }}">Home</a>
            <a href="{{ route('landing-page.halaman_destinasi') }}" class="nav-item nav-link {{ Request::routeIs('landing-page.halaman_destinasi') ? 'active' : '' }}">Destinasi</a>
            <a href="{{ route('landing-page.halaman_testimoni') }}" class="nav-item nav-link {{ Request::routeIs('landing-page.halaman_testimoni') ? 'active' : '' }}">Testimoni</a>
            <a href="{{ route('landing-page.halaman_sewabarang') }}" class="nav-item nav-link {{ Request::routeIs('landing-page.halaman_sewabarang') ? 'active' : '' }}">Perlengkapan Camping</a>
            
            <!-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Masuk</a>
                <div class="dropdown-menu m-0">
                    <a href="{{route('login')}}" class="dropdown-item">Masuk Akun Anda</a>
                </div>
            </div> -->

        </div>
    </div>
</nav>
