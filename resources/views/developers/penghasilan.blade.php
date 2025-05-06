@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container p-8 flex flex-col gap-6">
        <div class="--component-filter w-full">
            <ul class="flex items-center gap-2">
                <li class="text-[12px] font-medium">Filter:</li>
                <li><a class="{{ $title == 'Penghasilan' ? 'bg-[#F8F7F4]' : '' }} text-[14px] font-medium px-4 py-2 rounded-full"
                        href="{{ route('penghasilan.index') }}">Penghasilan</a></li>
                <li><a class="text-[14px] font-medium px-4 py-2 rounded-full"
                        href="{{ route('pengeluaran.index') }}">Pengeluaran</a></li>
            </ul>
        </div>
        <hr>
        <div class="--component-pertama w-full h-auto m-auto grid grid-cols-2 gap-4">
            <div class="--card-penghasilan-tahun-ini w-full h-auto m-auto">
                <div class="--title-heading mb-4 flex items-center justify-between">
                    <p class="font-bold text-[18px]">Total Pertahun</p>
                    {{-- <div class="--filter-export flex items-center gap-2">
                        <div><button
                                class="cursor-pointer gap-2 flex items-center px-4 py-2 bg-gradient-to-r from-[#B381F4] to-[#5038ED] rounded-[5px]">
                                <p class="mt-1"><i class="text-white fi fi-rr-inbox-out"></i></p>
                                <p class="text-white text-[14px] font-medium">Export</p>
                            </button></div>
                        <div><button
                                class="cursor-pointer gap-2 flex items-center px-4 py-2 bg-gradient-to-r from-[#283048] to-[#859398] rounded-[5px]">
                                <p class="mt-1"><i class="text-white fi fi-rr-settings-sliders"></i></p>
                                <p class="text-white text-[14px] font-medium">Filter</p>
                            </button></div>
                    </div> --}}
                </div>
                <div
                    class="--card w-full {{-- bg-[#E5F1FD]  --}} shadow-box-shadow-8 rounded-[20px] flex flex-col justify-between gap-4">
                    <div class="--header flex justify-between items-center">
                        <div class="--sub-1 p-4">
                            <p class="text-gray-400 font-medium text-[14px]">
                                Tahun {{ date('Y') }}:
                            </p>
                            <p class="text-[24px] font-bold mb-2">
                                Rp. {{ number_format($penghasilan_tahun_ini, 0, ',', '.') }}
                            </p>
                            <div class="--penghasilan-tahun-lalu">
                                <p class="text-[12px] font-normal">
                                    Total penghasilan tahun {{ date('Y', strtotime('-1 year')) }}:
                                </p>
                                <p class="font-bold text-[16px]">
                                    Rp. {{ number_format($penghasilan_tahun_lalu, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        {{-- <div class="--sub-2 p-4">
                            @if ($persentase_perubahan >= 0)
                                <p class="py-2 px-4 bg-[#F0FDF4] text-[#4AD07B] text-[14px] font-medium rounded-full">Naik :
                                    {{ number_format($persentase_perubahan, 2) }}% <i class="bi bi-arrow-up-right"></i></p>
                            @else
                                <p class="py-2 px-4 bg-[#FEF2F2] text-[#EF4444] text-[14px] font-medium rounded-full">Turun
                                    :
                                    {{ number_format($persentase_perubahan, 2) }} % <i class="bi bi-arrow-down-right"></i>
                                </p>
                            @endif
                        </div> --}}
                    </div>
                    <div class="--body">
                        <canvas id="penghasilan"></canvas>
                    </div>
                    <div class="--footer"></div>
                </div>
            </div>
            <div class="--card-penghasilan-hari-minggu-bulan-saat-ini flex flex-col gap-2">
                <div class="--title-heading flex items-center mb-4 justify-between">
                    <p class="font-bold text-[18px]">Total Lainnya</p>
                    {{-- <div><button
                            class="cursor-pointer opacity-0 gap-2 flex items-center px-4 py-2 bg-gradient-to-r from-[#283048] to-[#859398] rounded-[5px]">
                            <p class="mt-1"><i class="text-white fi fi-rr-settings-sliders"></i></p>
                            <p class="text-white text-[14px] font-medium">Filter</p>
                        </button></div> --}}
                </div>
                <div class="--card w-full grid grid-cols-2 gap-x-4">
                    <div class="--card-penghasilan-hari-ini w-full p-4 bg-[#080E2E] rounded-[20px]">
                        <div class="--header">
                            <p class="text-white font-medium text-[16px] mb-1">Total Perbulan</p>
                            <div class="--total">
                                <p class="text-[12px] font-bold text-gray-400">Bulan
                                    <b>{{ date('F') }}</b> {{ date('Y') }}
                                </p>
                                <p class="text-white text-[18px] font-medium">Rp.
                                    {{ number_format($monthCurrentTotal, 0, ',', '.') }}</p>

                            </div>
                        </div>
                        <div class="--body mb-4">
                            <canvas id="penghasilan-perbulan"></canvas>
                        </div>
                        <div class="--footer">
                            <p class="text-white text-[14px] font-semibold">Total Bulan lalu</p>
                            <div class="--card-total-bulan-lalu bg-white rounded-[10px] flex items-center justify-between">
                                <div class="-total p-4">
                                    <p class="font-bold text-gray-400 text-[12px]">Bulan
                                        {{ date('F', strtotime('-1 month')) }}</p>
                                    <p class="text-[#080E2E] font-medium">Rp.
                                        {{ number_format($monthPreviousTotal, 0, ',', '.') }}</p>
                                </div>
                                <div class="--icon bg-[#080E2E] rounded-tl-[10px] rounded-bl-[10px]">
                                    <i class="text-[20px] text-white p-2 bi bi-currency-exchange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="--card-penghasilan-minggu-ini w-full p-4 bg-[#C7B4EE] rounded-[20px]">
                        <div class="--header">
                            <p class="text-white font-medium text-[16px] mb-1">Total Perminggu</p>
                            <div class="--total">
                                <p class="text-[12px] font-normal text-gray-200">Minggu Bulan
                                    <b>{{ $currentMonth }}</b>
                                    {{ $currentYear }}
                                </p>
                                <p class="text-white text-[18px] font-medium">Rp.
                                    {{ number_format($currentWeekIncome, 2, ',', '.') }}</p>
                                {{-- <p class="text-white text-[12px]">
                                    @if ($percentageIncrease >= 0)
                                        Naik <b>{{ round($percentageIncrease) }}%</b> dari 3 minggu kemarin.
                                    @else
                                        Turun <b>{{ abs(round($percentageIncrease)) }}%</b> dari 3 minggu kemarin.
                                    @endif
                                </p> --}}
                            </div>
                        </div>
                        <div class="--body mb-4">
                            <canvas id="penghasilan-perminggu"></canvas>
                        </div>
                        <div class="--footer">
                            <p class="text-white text-[14px] font-semibold">Total Minggu lalu</p>
                            <div class="--card-total-bulan-lalu bg-white rounded-[10px] flex items-center justify-between">
                                <div class="-total p-4">
                                    <p class="font-bold text-gray-400 text-[12px]">Minggu ke {{ $previousWeekOfMonth }}</p>
                                    <p class="text-[#080E2E] font-medium">Rp.
                                        {{ number_format($previousWeekIncome, 2, ',', '.') }}</p>
                                </div>
                                <div class="--icon bg-[#C7B4EE] rounded-tl-[10px] rounded-bl-[10px]">
                                    <i class="text-[20px] text-white p-2 bi bi-currency-exchange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="--card-total-penghasilan-hari-ini flex items-center justify-between p-4 h-full rounded-[18px] bg-[#86C6CF]">
                    <div class="-image-title flex gap-2 items-center">
                        <div class="--image w-[40px] h-[40px] rounded-[10px] flex items-center justify-center bg-[#A4D4DB]">
                            <i class="text-white bi bi-calendar-week-fill"></i>
                        </div>
                        <div class="--title">
                            <p class="font-medium text-white text-[14px]">Penghasilan Hari ini - </p>
                            {{-- <p class="text-white text-[12px]">Mendapatkan <b>Rp. 6.564.245,00 Minggu lalu.</b></p> --}}
                        </div>
                    </div>
                    <div class="-total text-[16px] font-bold text-white">
                        Rp. {{ number_format($todayIncome, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="--component-kedua">
            {{-- <div class="--title text-[18px] font-bold">Data Pemasukan</div> --}}

            {{-- <div class="flex w-full justify-between items-center mb-4">


                <div class="_total">
                    <p class="text-[#19191b] text-[14px] font-bold">1.235.134 Customer</p>
                </div>


                <div class="_search-filter flex gap-4">

                    <div class="_search">
                        <div class="_search">
                            <form class="form">
                                <label for="search">
                                    <input class="input" type="text" required="" placeholder="Cari kata"
                                        id="search">
                                    <div class="fancy-bg"></div>
                                    <div class="search">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"
                                            class="r-14j79pv r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-4wgw6l r-f727ji r-bnwqim r-1plcrui r-lrvibr">
                                            <g>
                                                <path
                                                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <button class="close-btn" type="reset">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </label>
                            </form>
                        </div>
                    </div>


                    <div class="_filter">
                        <div class="flex items-center justify-center">
                            <div class="relative inline-block text-left">
                                <button id="dropdown-button"
                                    class="flex items-center gap-[5px] justify-center w-full px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                    <i class="mt-[2px] text-[14px] fi fi-rr-settings-sliders"></i>
                                    <p class="text-[14px]">Filter</p>
                                </button>
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


                    <div class="_btn-tambah-data">
                        <button onclick="modalHandler(true)"
                            class="px-4 py-2 gradient-1 cursor-pointer text-white rounded-full">
                            <div class="_icon-plus"></div>
                            <span>Tambah Pemasukan</span>
                        </button>
                    </div>
                </div>
            </div> --}}
            {{-- todo wrapper btn delete all, btn export data bentuk ke excel --}}
            {{-- <div class="flex items-center gap-4 w-full">

                <div><button
                        class="cursor-pointer gap-2 flex items-center px-4 py-2 bg-gradient-to-r from-[#B381F4] to-[#5038ED] rounded-[5px]">
                        <p class="mt-1"><i class="text-white fi fi-rr-inbox-out"></i></p>
                        <p class="text-white text-[14px] font-medium">Export</p>
                    </button></div>

                <div>
                    <button class="px-4 py-2 bg-[#F06D6B] rounded-[5px] flex items-center gap-2">
                        <p class="mt-1"><i class="text-white fi fi-rr-trash"></i></p>
                        <p class="text-[14px] font-medium text-white">Hapus</p>
                    </button>
                </div>
            </div> --}}
            {{-- <div class="--table w-full h-auto mt-4">
                <div class="relative w-full h-[500px] overflow-hidden shadow-box-shadow-11 rounded-[20px] bg-white">
                    <div class="w-full h-full overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="sticky top-0 z-10 text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-3 py-3 max-w-[50px]">
                                        <div class="inline-flex items-center">
                                            <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                                htmlFor="check">
                                                <input type="checkbox"
                                                    class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border-2 border-gray-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                                    id="check" />
                                                <span
                                                    class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                        viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                        stroke-width="1">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sumber
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Pemasukan
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
                                @for ($i = 0; $i < 20; $i++)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-3">
                                            <div class="inline-flex items-center">
                                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                                    htmlFor="check">
                                                    <input type="checkbox"
                                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border-2 border-gray-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                                        id="check" />
                                                    <span
                                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                            stroke-width="1">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 flex items-center gap-2 whitespace-nowrap dark:text-white">
                                            <p>Layanan Transaksi</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="py-2 px-4 w-fit bg-[#F0FDF4] text-[#4ED17E] rounded-full">
                                                2 November 2024</p>
                                        </td>
                                        <td class="px-6 py-4 line-clamp-1 max-w-[200px]">
                                            Transaksi penyewaan antar customer dari aplikasi mobile
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp. 1.000.000
                                        </td>
                                        <td class="px-6 py-4 flex gap-2 items-center">
                                            <p><a href=""><i class="text-[16px] bi bi-pen-fill"></i></a>
                                            </p>
                                            <p><a href=""><i class="text-[16px] bi bi-trash-fill"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
