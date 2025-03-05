<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- import untuk font google poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- import cdn icon bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- import cdn icon flaticon --}}
    <link rel="stylesheet" href="{{ asset('css/cdn/flaticon.css') }}">

    {{-- import ico tab bar --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.ico') }}">

    {{-- import style css --}}
    <link rel="stylesheet" href="{{ asset('css/gradient/gradient-color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/arsir/corak.css') }}">
    <link rel="stylesheet" href="{{ asset('css/universeio/input-for-data-feedback.css') }}">
    <link rel="stylesheet" href="{{ asset('css/input/numbertype.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/fonts/fonts.css') }}">

    {{-- import icon untuk tab --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>{{ $title }}</title>

    {{-- import vite tailwind --}}
    @vite('resources/css/app.css')
</head>

<body class="overflow-x-hidden">
    <div class="_container w-full flex font-poppins">
        {{-- untuk side bar --}}
        <div class="_sidebar ml-64 small-desktop:ml-auto">
            @include('components.sidebars.sideabar1')
        </div>

        {{-- untuk navbar dan kontent --}}
        <div
            class="_navbar-and-content w-full font-poppins {{ $title == 'Profile | Developer Kamp Sewa' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Rekap Keuangan | Developer' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Pengeluaran' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Penghasilan' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Penyewaan' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Detail Produk Sedang Disewa' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Detail Produk Disewakan' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Produk Disewakan' ? 'bg-white' : 'bg-[#EFF2F7]' }} {{ $title == 'Detail Pengguna' ? 'bg-white' : 'bg-[#EFF2F7]' }} ">
            @include('components.navbars.navbar1')
            @yield('content')
        </div>

        {{-- import library chartjs --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- import chart js style --}}
        <script src="{{ asset('js/chart-finance.js') }}"></script>
        <script src="{{ asset('js/chart-keuntungan.js') }}"></script>
        <script src="{{ asset('js/chart-kerugian.js') }}"></script>
        <script src="{{ asset('js/char-penghasilan-pertahun.js') }}"></script>
        <script src="{{ asset('js/chart-totalperbulan.js') }}"></script>
        <script src="{{ asset('js/chart-totalperminggu.js') }}"></script>
        <script src="{{ asset('js/chart-pengeluaran.js') }}"></script>
        <script src="{{ asset('js/chart-pebandingan-keuntungan.js') }}"></script>
    </div>

    @include('sweetalert::alert')
</body>

</html>
