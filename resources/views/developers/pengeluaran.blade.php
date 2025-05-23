@php
    // Mendapatkan nama hari dalam bahasa Inggris
    $nama_hari_inggris = date('l');

    // Mengonversi nama hari dalam bahasa Inggris menjadi bahasa Indonesia
    $nama_hari_indonesia = '';
    $hari_map = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];

    // Menggunakan foreach untuk mencocokkan nama hari
    foreach ($hari_map as $hari_inggris => $hari_indonesia) {
        if ($nama_hari_inggris === $hari_inggris) {
            $nama_hari_indonesia = $hari_indonesia;
            break;
        }
    }

    // Array untuk menyimpan warna yang telah digunakan
    $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];
    $color_count = count($colors);

    $data_vector = [
        'images/illustration/DrawKit Vector Illustration Black Friday & Online Shopping (1).svg',
        'images/illustration/DrawKit Vector Illustration Black Friday & Online Shopping (2).svg',
        'images/illustration/DrawKit Vector Illustration Black Friday & Online Shopping (3).svg',
        'images/illustration/DrawKit Vector Illustration Black Friday & Online Shopping (4).svg',
        'images/illustration/DrawKit Vector Illustration Black Friday & Online Shopping (5).svg',
        'images/illustration/DrawKit Vector Illustration Black Friday & Online Shopping (6).svg',
        'images/illustration/DrawKit Vector Illustration Black Friday & Online Shopping (7).svg',
    ];

    $data_nama = ['Agung Kurniawan', 'Jokowi Dodo', 'Dewi Ayu', 'Budi Hartono', 'Ucup Surucup', 'Sri Purwanti'];
@endphp
@extends('layouts.developers.ly-dashboard')
@section('content')
    @include('components.modals.tambah-pengeluaran')
    <div class="--container w-full h-auto p-8 flex flex-col gap-6">
        <div class="--component-filter w-full">
            <ul class="flex items-center gap-2">
                <li class="text-[12px] font-medium">Filter:</li>
                <li><a class="{{ $title == 'Penghasilan' ? 'bg-[#F8F7F4]' : '' }} text-[14px] font-medium px-4 py-2 rounded-full"
                        href="{{ route('penghasilan.index') }}">Penghasilan</a></li>
                <li><a class="{{ $title == 'Pengeluaran' ? 'bg-[#F8F7F4]' : '' }} text-[14px] font-medium px-4 py-2 rounded-full"
                        href="{{ route('pengeluaran.index') }}">Pengeluaran</a></li>
            </ul>
        </div>
        <hr>
        <div class="--component-card w-full h-auto flex flex-col gap-6">
            <div class="--wrapper-cetak-filter w-auto h-auto flex gap-2 items-center">
                {{-- <div class="--cetak-button">
                    <div><button
                            class="cursor-pointer gap-2 flex items-center px-4 py-2 bg-gradient-to-r from-[#B381F4] to-[#5038ED] rounded-[5px]">
                            <p class="mt-1"><i class="text-white fi fi-rr-inbox-out"></i></p>
                            <p class="text-white text-[14px] font-medium">Export</p>
                        </button></div>
                </div> --}}
                {{-- <div class="--filter-button">
                    <div><button
                            class="cursor-pointer gap-2 flex items-center px-4 py-2 bg-gradient-to-r from-[#283048] to-[#859398] rounded-[5px]">
                            <p class="mt-1"><i class="text-white fi fi-rr-settings-sliders"></i></p>
                            <p class="text-white text-[14px] font-medium">Filter</p>
                        </button></div>
                </div> --}}
            </div>
            <div class="--wrapper-card w-full h-auto grid grid-cols-2 gap-4">
                <div
                    class="--card-pengeluaran-pertahun bg-white p-4 flex flex-col gap-4 shadow-box-shadow-8 rounded-[20px]">
                    <div class="--header flex items-center justify-between">
                        <div class="--sub-header">
                            <p class="text-[16px]">Pengeluaran Pertahun - {{ date('Y') }}</p>
                            <div class="--total-persen flex items-center gap-2">
                                <p class="text-[24px] font-medium">Rp. {{ number_format($pengeluaran_tahun_ini) }}</p>

                            </div>
                        </div>
                        <div class="--filter">
                            <button class="flex items-center px-4 py-1 bg-[#F4F5F7] rounded-full">
                                <div class="text-[12px] font-medium">Tahun {{ date('Y') }}</div>
                                <div class="mt-1"><i class="text-[14px] fi fi-rr-angle-small-down"></i></div>
                            </button>
                        </div>
                    </div>
                    <div class="--body">
                        <canvas id="chart-pengeluaran-pertahun"></canvas>
                    </div>
                    <div class="footer grid w-full grid-cols-2 gap-2">
                        <div
                            class="--pengeluaran-tahun-sebelumnya flex items-center gap-2 bg-[#F4F5F7] p-2 rounded-full w-full">
                            <div class="--icon w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center"><i
                                    class="mt-1 text-[20px] fi fi-rr-book-bookmark"></i></div>
                            <div class="--title">
                                <p class="text-[10px] font-medium">Tahun {{ date('Y', strtotime('-1 year')) }}</p>
                                <p class="text-[12px] font-bold">Rp. {{ number_format($pengeluaran_tahun_lalu) }}</p>
                            </div>
                        </div>
                        <div
                            class="--pengeluaran-dua-tahun-sebelumnya flex items-center gap-2 bg-[#F4F5F7] p-2 rounded-full w-full">
                            <div class="--icon w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center"><i
                                    class="text-[20px] mt-1 fi fi-rr-folder-open"></i></div>
                            <div class="--title">
                                <p class="text-[10px] font-medium">Tahun {{ date('Y', strtotime('-2 year')) }}</p>
                                <p class="text-[12px] font-bold">Rp.{{ number_format($pengeluaran_2tahun_lalu) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="--card-pengeluaran-perbulan bg-white p-4 flex flex-col gap-4 shadow-box-shadow-8 rounded-[20px]">
                    <div class="--header flex items-center justify-between">
                        <div class="--sub-header">
                            <p class="text-[16px]">Pengeluaran Perbulan - {{ date('F') }}-{{ date('Y') }}</p>
                            <div class="--total-persen flex items-center gap-2">
                                <p class="text-[24px] font-medium">Rp. {{ number_format($total_perbulan_ini) }}</p>
                                {{-- <div
                                    class="--persen flex items-center px-2 py-1 text-[12px] font-medium rounded-full bg-[#F3D1ED] text-[#EF5D5B]">
                                    <p class="mt-1"><i class="fi fi-rr-arrow-small-up"></i></p>
                                    <p>+12%</p>
                                </div> --}}
                            </div>
                        </div>
                        <div class="--filter">
                            <button class="flex items-center px-4 py-1 bg-[#F4F5F7] rounded-full">
                                <div class="text-[12px] font-medium">{{ date('F') }}</div>
                                <div class="mt-1"><i class="text-[14px] fi fi-rr-angle-small-down"></i></div>
                            </button>
                        </div>
                    </div>
                    <div class="--body">
                        <canvas id="chart-pengeluaran-perbulan"></canvas>
                    </div>
                    <div class="footer grid w-full grid-cols-2 gap-2">
                        <div
                            class="--pengeluaran-tahun-sebelumnya flex items-center gap-2 bg-[#F4F5F7] p-2 rounded-full w-full">
                            <div class="--icon w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center"><i
                                    class="mt-1 text-[20px] fi fi-rr-book-bookmark"></i></div>
                            <div class="--title">
                                <p class="text-[10px] font-medium">Bulan {{ date('F', strtotime('-1 month')) }} -
                                    {{ date('Y') }}</p>
                                <p class="text-[12px] font-bold">Rp. {{ number_format($total_perbulan_lalu) }}</p>
                            </div>
                        </div>
                        <div
                            class="--pengeluaran-dua-tahun-sebelumnya flex items-center gap-2 bg-[#F4F5F7] p-2 rounded-full w-full">
                            <div class="--icon w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center"><i
                                    class="text-[20px] mt-1 fi fi-rr-folder-open"></i></div>
                            <div class="--title">
                                <p class="text-[10px] font-medium">Bulan {{ date('F'), strtotime('-2 month') }} -
                                    {{ date('Y') }}</p>
                                <p class="text-[12px] font-bold">Rp. {{ number_format($total_2bulan_lalu) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="--componeent-card-two grid grid-cols-2 gap-4">
            <div class="--card-total-pengeluaran-minggu-ini-total-pengeluaran-hari-ini w-full h-auto flex flex-col gap-2">
                <div
                    class="--total-pengeluaran-minggu-ini relative flex flex-col justify-between gap-4 w-full h-full text-white p-4 rounded-[20px] m-auto bg-[#222222]">
                    <img class="absolute w-[150px] h-[150px] object-cover right-0 bottom-0" src="{{ asset('images/illustration/9 SCENE.svg') }}" alt="">
                    <div class="--title-filter flex items-center justify-between">
                        <div class="--title">
                            <p class="text-[14px] font-medium">Pengeluaran Minggu Ini</p>
                            <p class="text-[12px]">Pengeluaran minggu ini bulan <b>Mei</b> tahun {{ date('Y') }}. Pengeluaran ini hanya menghitung total dari tahun dan bulan saat ini.</p>
                        </div>
                        <div class="--filter">
                            <button class="flex items-center px-4 py-1 bg-[#5F5F5F] rounded-full">
                                <div class="text-[10px] font-medium whitespace-nowrap">Minggu 1</div>
                                <div class="mt-1"><i class="text-[14px] fi fi-rr-angle-small-down"></i></div>
                            </button>
                        </div>
                    </div>
                    <p class="text-[24px]">Rp. 243.550.120,00</p>
                    <div class="--total-pengeluaran-hari-ini">
                        <p class="text-[12px]">Total Minggu kemarin : <b>Rp. 243.550.120,00</b></p>
                    </div>
                </div>
                <div
                    class="--total-pengeluaran-hari-ini relative flex justify-between flex-col gap-4 w-full h-full text-white p-4 rounded-[20px] m-auto bg-[#7015EC]">
                    <img class="absolute w-[150px] h-[150px] object-cover right-0 bottom-0" src="{{ asset('images/illustration/3 SCENE.svg') }}" alt="">
                    <div class="--title-filter flex items-center justify-between">
                        <div class="--title">
                            <p class="text-[14px] font-medium">Pengeluaran Hari Ini</p>
                            <p class="text-[12px]">Pengeluaran hari <b>{{ $nama_hari_indonesia }}</b> bulan <b>Mei</b> tahun
                                {{ date('Y') }}. Pengeluaran ini hanya menghitung total dari bulan dan tahun saat ini.</p>
                        </div>
                        <div class="--filter">
                            <button class="flex items-center px-4 py-1 bg-[#F4F5F7] rounded-full">
                                <div class="text-[12px] text-black font-medium">{{ $nama_hari_indonesia }}</div>
                                <div class="mt-1"><i class="text-[14px] text-black fi fi-rr-angle-small-down"></i></div>
                            </button>
                        </div>
                    </div>
                    <p class="text-[24px]">Rp. 243.550.120,00</p>
                    <div class="--total-pengeluaran-hari-ini">
                        <p class="text-[12px]">Total hari kemarin : <b>Rp. 243.550.120,00</b></p>
                    </div>
                </div>
            </div>
            <div
                class="--card-input-data-pengeluaran-baru-baru-ini p-4 w-full h-auto bg-white shadow-box-shadow-11 rounded-[20px]">
                <p class="text-[18px] font-medium">Pengeluaran Baru Ini</p>
                <div class="--wrapper-card-data-list w-full max-h-[350px] p-1 overflow-y-auto mt-2 flex flex-col gap-2">
                    @for ($i = 0; $i < 6; $i++)
                        <a href="">
                            <div
                                class="--data-items-list w-full p-4 bg-[#F4F5F7] hover:bg-[#F8F7F4] rounded-[8px] flex items-center gap-2">
                                @php
                                    // Mendapatkan indeks warna yang sesuai dengan jumlah iterasi
                                    $color_index = $i % $color_count;
                                @endphp
                                <div class="--image min-w-[80px] min-h-[80px] p-1 rounded-[5px]"
                                    style="background-color: {{ $colors[$color_index] }}">
                                    <img class="w-[80px] h-[80px] object-cover" src="{{ asset($data_vector[$i]) }}"
                                        alt="">
                                </div>
                                <div class="--title-content">
                                    <p class="text-[16px] font-bold">{{ $data_nama[$i] }} <sup
                                            class="font-normal">dev</sup></p>
                                    <p class="text-[12px] line-clamp-2">Pengeluaran ini digunakan untuk pembayaran media
                                        hosting
                                        database dan media hosting website juga penambahan biaya untuk dinas kantor
                                        provider.</p>
                                    <div class="--data-more w-full flex mt-2 items-center gap-2">
                                        <p class="text-[12px] font-medium py-1 px-2 bg-white rounded-full">Service</p>
                                        <p class="text-[12px] font-medium">20 November 2024</p>
                                        <div class="w-[2px] h-[15px] bg-[#2b2b2b2b]"></div>
                                        <p class="text-[12px] font-bold">Rp. 25.550.000,00</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>
        </div> --}}
        <div class="--component-kedua">
            <div class="--title text-[18px] font-bold">Data Pengeluaran</div>
            {{-- todo wrapper total search filter --}}
            <div class="flex w-full justify-between items-center mb-4">

                {{-- todo total users --}}
                <div class="_total">
                    {{-- <p class="text-[#19191b] text-[14px] font-bold">1.235.134 Customer</p> --}}
                </div>

                {{-- todo wrapper search filter --}}
                <div class="_search-filter flex gap-4">
                    {{-- todo search --}}
                    <div class="_search">
                        <div class="_search">
                            <form class="form" method="GET" action="{{ route('pengeluaran.index') }}">
                                <label for="search">
                                    <input class="input" type="text" name="search" required placeholder="Cari kata"
                                        id="search" value="{{ request('search') }}">
                                    <div class="fancy-bg"></div>
                                    <div class="search">
                                        <!-- icon -->
                                    </div>
                                    <a href="{{ route('pengeluaran.index') }}" class="close-btn" title="Reset">
                                        <!-- ganti icon-nya sesuai keinginan -->
                                        ❌
                                    </a>
                                </label>
                            </form>

                        </div>
                    </div>

                    {{-- todo filter --}}
                    <div class="_filter">
                        <div class="flex items-center justify-center">
                            <div class="relative inline-block text-left">

                                <div id="dropdown-menu"
                                    class="origin-top-right z-10 absolute hidden right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                    <div class="py-2 p-2" role="menu" aria-orientation="vertical"
                                        aria-labelledby="dropdown-button">
                                        <a class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                            role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="light"
                                                width="18px" class="mr-2">
                                                <path
                                                    d="M19 9.199h-.98c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799H19c.552 0 1-.357 1-.799 0-.441-.449-.801-1-.801zM10 4.5A5.483 5.483 0 0 0 4.5 10c0 3.051 2.449 5.5 5.5 5.5 3.05 0 5.5-2.449 5.5-5.5S13.049 4.5 10 4.5zm0 9.5c-2.211 0-4-1.791-4-4 0-2.211 1.789-4 4-4a4 4 0 0 1 0 8zm-7-4c0-.441-.449-.801-1-.801H1c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799h1c.551 0 1-.358 1-.799zm7-7c.441 0 .799-.447.799-1V1c0-.553-.358-1-.799-1-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1zm0 14c-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1 .441 0 .799-.447.799-1v-1c0-.553-.358-1-.799-1zm7.365-13.234c.391-.391.454-.961.142-1.273s-.883-.248-1.272.143l-.7.699c-.391.391-.454.961-.142 1.273s.883.248 1.273-.143l.699-.699zM3.334 15.533l-.7.701c-.391.391-.454.959-.142 1.271s.883.25 1.272-.141l.7-.699c.391-.391.454-.961.142-1.274s-.883-.247-1.272.142zm.431-12.898c-.39-.391-.961-.455-1.273-.143s-.248.883.141 1.274l.7.699c.391.391.96.455 1.272.143s.249-.883-.141-1.273l-.699-.7zm11.769 14.031l.7.699c.391.391.96.453 1.272.143.312-.312.249-.883-.142-1.273l-.699-.699c-.391-.391-.961-.455-1.274-.143s-.248.882.143 1.273z">
                                                </path>
                                            </svg> Light
                                        </a>
                                        <a class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                            role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="moon"
                                                width="18px" class="mr-2">
                                                <path
                                                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z">
                                                </path>
                                            </svg> Dark
                                        </a>
                                        <a class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                            role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="mr-2"
                                                viewBox="0 0 32 32" id="desktop">
                                                <path
                                                    d="M30 2H2a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2h9.998c-.004 1.446-.062 3.324-.61 4h-.404A.992.992 0 0 0 10 29c0 .552.44 1 .984 1h10.03A.992.992 0 0 0 22 29c0-.552-.44-1-.984-1h-.404c-.55-.676-.606-2.554-.61-4H30a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM14 24l-.002.004L14 24zm4.002.004L18 24h.002v.004zM30 20H2V4h28v16z">
                                                </path>
                                            </svg> System
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- todo untuk tombol tambah data --}}
                    <div class="_btn-tambah-data">
                        <button id="btn-tambah-pengeluaran" class="gradient-1 text-white px-4 py-2 rounded-lg"><i
                                class="bi bi-plus-lg"></i> Tambah
                            Pengeluaran</button>
                    </div>
                </div>
            </div>
            {{-- todo wrapper btn delete all, btn export data bentuk ke excel --}}
            <div class="flex items-center gap-4 w-full">
                {{-- todo btn export --}}
                <div>
                    <button onclick="exportData()"
                        class="cursor-pointer gap-2 flex items-center px-4 py-2 bg-gradient-to-r from-[#B381F4] to-[#5038ED] rounded-[5px]">
                        <p class="mt-1"><i class="text-white fi fi-rr-inbox-out"></i></p>
                        <p class="text-white text-[14px] font-medium">Export</p>
                    </button>
                </div>
                {{-- todo btn delete all --}}
                <div>

                </div>
            </div>
            <div class="--table w-full h-auto mt-4">
                <div class="relative w-full h-[500px] overflow-hidden shadow-box-shadow-11 rounded-[20px] bg-white">
                    <div class="w-full h-full overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="sticky top-0 z-10 text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>

                                    <th scope="col" class="px-6 py-3">
                                        Sumber
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Pengeluaran
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Deskripi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nominal
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_pengeluaran as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 flex items-center gap-2 whitespace-nowrap dark:text-white">
                                            <p>{{ $item->sumber }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="py-2 px-4 w-fit bg-[#F0FDF4] text-[#4ED17E] rounded-full">
                                                {{ $item->created_at }}</p>
                                        </td>
                                        <td class="px-6 py-4 line-clamp-1 max-w-[200px]">
                                            {{ $item->deskripsi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp. {{ number_format($item->nominal, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-2 items-center">
                                            <p><button id="btn-ubah-pengeluaran"
                                                    onclick="ubah_pengeluaran({{ $item }})"><i
                                                        class="text-[16px] bi bi-pen-fill"></i></button>
                                            </p>
                                            <p><a href="#" onclick="hapus_pengeluaran({{ $item->id }})"><i
                                                        class="text-[16px] bi bi-trash-fill"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="modal-ubah-pengeluaran-customer" class="hidden">
        <div
            class="_container w-full h-screen flex justify-center items-center z-20 fixed top-0 left-0 bg-white/0 backdrop-blur-sm">
            <div
                class="_card w-[500px] flex flex-col h-[500px] overflow-clip bg-white p-[20px] rounded-[20px] shadow-box-shadow-11">
                <div class="_header w-full">
                    <div class="_title flex items-center gap-2">
                        <div class="w-[35px] h-[35px] rounded-full flex justify-center items-center text-white gradient-1">
                            <i class="bi bi-currency-bitcoin"></i>
                        </div>
                        <span class="text-[16px] font-bold">Ubah Pengeluaran</span>
                    </div>
                    <div class="_close"></div>
                </div>
                <div class="_body w-full mt-4 flex-grow p-2 overflow-y-auto">




                    <form method="POST" id="form-ubah-pengeluaran"
                        action="{{ route('keuangan.update-pengeluaran-developer') }}" class="w-full flex flex-col gap-2">

                        {{-- <form method="POST" id="form-tambah-pengeluaran"
                        action="{{ route('keuangan.tambah-pengeluaran-customer', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                        class="w-full flex flex-col gap-2"> --}}
                        @csrf
                        <input type="hidden" name="id_user" value="{{ session('id_user') }}">
                        <div class="_input w-full">
                            <label for="fullname">Sumber</label>
                            <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                                placeholder="Masukkan sumber pemasukan" type="text" id="sumber_pengeluaran_customerr"
                                name="sumber" required>
                        </div>
                        <div class="_input w-full">
                            <label for="number_phone">Deskripsi</label>
                            <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                                placeholder="Masukkan deskripsi pemasukan" type="text"
                                id="deskripsi_pengeluaran_customerr" name="deskripsi" required>
                        </div>
                        <div class="_input w-full">
                            <label for="password">Nominal</label>
                            <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                                placeholder="Masukkan nominal pemasukan" type="number"
                                id="nominal_pengeluaran_customerr" name="nominal" required>
                        </div>
                        <input type="hidden" name="id" id="id_pengeluaran_customerr">



                </div>
                <hr>
                <div class="_footer w-full p-2 flex gap-2">
                    <button id="ubah-pengeluaran" class="gradient-1 text-white text-[14px] py-2 px-4 rounded-full"
                        type="submit">Simpan</button>
                    <button type="button" class="text-[14px] shadow-box-shadow-8 py-2 px-4 rounded-full"
                        id="cancel-ubah-pengeluaran-web-customer">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tambahkan fungsi ubah_pengeluaran
        function ubah_pengeluaran(item) {
            const modal = document.getElementById('modal-ubah-pengeluaran-customer');

            // Isi form dengan data yang akan diubah
            document.getElementById('sumber_pengeluaran_customerr').value = item.sumber;
            document.getElementById('deskripsi_pengeluaran_customerr').value = item.deskripsi;
            document.getElementById('nominal_pengeluaran_customerr').value = item.nominal;
            document.getElementById('id_pengeluaran_customerr').value = item.id;

            // Ubah action form untuk update


            // Tampilkan modal
            modal.style.display = "flex";
        }

        // Tambahkan event listener untuk modal edit
        const modalEdit = document.getElementById('modal-ubah-pengeluaran-customer');
        const cancelEditButton = modalEdit.querySelector('button[id="cancel-ubah-pengeluaran-web-customer"]');

        cancelEditButton.addEventListener('click', () => {
            modalEdit.style.display = "none";
        });

        function hapus_pengeluaran(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Jika dihapus, data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/developer/dashboard/keuangan/hapus-pengeluaran/${id}`;
                }
            })
        }

        const modal = document.getElementById('modal-tambah-pengeluaran-customer');
        const idButton = document.getElementById('btn-tambah-pengeluaran');
        const submitPemasukan = document.getElementById('tambah-pengeluaran');
        const formTambahPemasukan = document.getElementById('form-tambah-pengeluaran');
        const cancelButton = document.getElementById('cancel-tambah-pengeluaran-web-customer');

        function modalHandlerPemasukanCustomer(val) {
            if (val) {
                modal.style.display = "flex";
            } else {
                modal.style.display = "none";
            }
        }

        // function isString
        function isStringInputPemasukanCustomer(value) {
            const lettersAndSpacesOnlyRegex = /^[A-Za-z\s]+$/;
            return lettersAndSpacesOnlyRegex.test(value);
        }

        // function isNumeric
        function isNumericPemasukanCustomer(value) {
            const numbersOnlyRegex = /^[0-9]+$/;
            return numbersOnlyRegex.test(value)
        }

        idButton.addEventListener('click', (event) => {
            modalHandlerPemasukanCustomer(true);
        });

        submitPemasukan.addEventListener('click', function(event) {
            event.preventDefault();

            // input tambah-pemasukan-customer.blade.php
            let sumber = document.getElementById('sumber_pengeluaran_customer').value.trim();
            let deskripsi = document.getElementById('deskripsi_pengeluaran_customer').value.trim();
            let nominal = document.getElementById('nominal_pengeluaran_customer').value.trim();

            if (sumber === '') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Input Sumber Kosong!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                return;
            } else if (!isStringInputPemasukanCustomer(sumber)) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Input Sumber tidak boleh angka!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                return;
            } else if (deskripsi === '') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Input Deskripsi Kosong!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                return;
            } else if (nominal === '') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Input Nominal Kosong!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                return;
            } else if (!isNumericPemasukanCustomer(nominal)) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Input Nominal tidak boleh huruf!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                return;
            }
            Swal.fire({
                title: 'Menyimpan data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit formulir setelah penundaan kecil
            setTimeout(() => {
                formTambahPemasukan.submit();
            }, 1000);
        });

        cancelButton.addEventListener('click', () => {
            modalHandlerPemasukanCustomer(false);
        });








        function exportData() {
            // Dapatkan parameter pencarian saat ini
            const searchParams = new URLSearchParams(window.location.search);
            const searchTerm = searchParams.get('search') || '';

            // Tampilkan loading
            Swal.fire({
                title: 'Mempersiapkan data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            // Buat URL untuk export dengan parameter yang sama
            const exportUrl = `/developer/dashboard/keuangan/export-pengeluaran?search=${encodeURIComponent(searchTerm)}`;

            // Buat elemen <a> sementara untuk memicu download
            const link = document.createElement('a');
            link.href = exportUrl;
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Tutup loading setelah beberapa saat (jika download tidak otomatis menutupnya)
            setTimeout(() => {
                Swal.close();
            }, 2000);
        }
    </script>
@endsection
