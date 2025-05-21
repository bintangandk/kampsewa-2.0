@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="--container w-full h-auto p-8 flex flex-col gap-6">
        <div class="--component-filter w-full">
            <ul class="flex items-center gap-2">
                <li class="text-[12px] font-medium">Filter:</li>
                <li>
                    <a href="{{ route('report.index') }}"
                        class="{{ request()->routeIs('report.index') ? 'bg-[#F8F7F4]' : '' }} text-[14px] font-medium px-4 py-2 rounded-full">
                        Pending
                    </a>
                </li>
                <li>
                    <a href="{{ route('report.tolak') }}"
                        class="{{ request()->routeIs('report.tolak') ? 'bg-[#F8F7F4]' : '' }} text-[14px] font-medium px-4 py-2 rounded-full">
                        Ditolak
                    </a>
                </li>
                <li>
                    <a href="{{ route('report.terima') }}"
                        class="{{ request()->routeIs('report.terima') ? 'bg-[#F8F7F4]' : '' }} text-[14px] font-medium px-4 py-2 rounded-full">
                        Diterima
                    </a>
                </li>
            </ul>
        </div>

        <hr>

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
        </div> --}}
    </div>
    <div class="--component-kedua">
        <div class="--title text-[18px] font-bold">Data Report {{ $status }}</div>
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
                        <form class="form">
                            <label for="search">
                                <input class="input" type="text" required="" placeholder="Cari kata" id="search">
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

            </div>
        </div>
        {{-- todo wrapper btn delete all, btn export data bentuk ke excel --}}
        <div class="flex items-center gap-4 w-full">
            {{-- todo btn export --}}

        </div>
    </div>
    <div class="--table w-full h-auto mt-4">
        <div class="relative w-full h-[500px] overflow-hidden shadow-box-shadow-11 rounded-[20px] bg-white">
            <div class="w-full h-full overflow-x-auto">
                @if ($data->isEmpty())
                    <div class="w-full h-[300px] flex justify-center items-center">
                        <div class="bg-white shadow-md rounded-lg p-6 text-center">
                            <h2 class="text-gray-700 text-lg font-semibold">Data tidak ada</h2>
                            <p class="text-sm text-gray-500">Tidak ditemukan laporan untuk saat ini.</p>
                        </div>
                    </div>
                @else
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead
                            class="sticky top-0 z-10 text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Pelapor</th>
                                <th scope="col" class="px-6 py-3">Tanggal Lapor</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Bukti Laporan</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $report)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $report->pelapor->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="py-2 px-4 w-fit bg-[#F0FDF4] text-[#4ED17E] rounded-full">
                                            {{ $report->created_at->format('d M Y') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 line-clamp-1 max-w-[200px]">
                                        {{ $report->deskripsi }}
                                    </td>
                                    <td class="px-6 py-4 capitalize">
                                        {{ $report->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('uploads/report/' . $report->bukti_laporan) }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            Lihat Bukti
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 flex gap-2 items-center">
                                        @if ($report->status == 'pending')
                                            <button onclick="openVerifikasiModal({{ $report }})"
                                                class="bg-[#FBBF24] text-black py-2 px-4 rounded-full">
                                                Verifikasi
                                            </button>
                                        @endif
                                        {{-- <a href="{{ route('detail_report') }}"></a> --}}
                                        <a href="{{ route('detail_report', ['id_penyewaan' => $report->id_penyewaan, 'status' => $status]) }}"
                                            class="bg-blue-100 text-blue-600 px-4 py-2 rounded-md hover:bg-blue-200 transition">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
    </div>
    </div>


    <div id="verifikasi-modal" class="hidden">
        <div
            class="_container w-full h-screen flex justify-center items-center z-20 fixed top-0 left-0 bg-white/0 backdrop-blur-sm">
            <div
                class="_card w-[500px] flex flex-col h-[500px] overflow-clip bg-white p-[20px] rounded-[20px] shadow-box-shadow-11">
                <div class="_header w-full">
                    <div class="_title flex items-center gap-2">
                        <div class="w-[35px] h-[35px] rounded-full flex justify-center items-center text-white gradient-1">
                            <i class="bi bi-currency-bitcoin"></i>
                        </div>
                        <span class="text-[16px] font-bold">Verifikasi Laporan</span>
                    </div>
                    <div class="_close"></div>
                </div>
                <div class="_body w-full mt-4 flex-grow p-2 overflow-y-auto">


                    <form method="post" action="{{ route('verifikasi_report') }}" class="w-full flex flex-col gap-2">
                        {{-- @endif --}}
                        {{-- <form method="POST" id="form-tambah-pengeluaran"
                    action="{{ route('keuangan.tambah-pengeluaran-customer', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                    class="w-full flex flex-col gap-2"> --}}
                        @csrf
                        <input type="hidden" name="id_report" id="id_report">
                        <div class="_input w-full">
                            <label for="fullname">Verifikasi</label>
                            <select class="border w-full border-solid rounded-[10px] text-[14px] p-2" id="status"
                                name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="terima">Diterima</option>
                                <option value="tolak">Ditolak</option>
                            </select>
                        </div>


                </div>
                <hr>
                <div class="_footer w-full p-2 flex gap-2">
                    <button type="submit"
                        class="gradient-1 text-white text-[14px] py-2 px-4 rounded-full">Simpan</button>

                    </form>
                    <button class="text-[14px] shadow-box-shadow-8 py-2 px-4 rounded-full"
                        id="cancel-tambah-pengeluaran-web-customer" onclick="closeVerifikasiModal()">
                        Cancel
                    </button>

                </div>
            </div>
        </div>
    </div>





    <script>
        function openVerifikasiModal(reportId) {
            const modal = document.getElementById('verifikasi-modal');

            document.getElementById('id_report').value = reportId.id;





            // Update action URL dengan ID yang diklik
            // form.action = `/developer/dashboard/report/verifikasi/${reportId}`;

            modal.classList.remove('hidden');
        }

        function closeVerifikasiModal() {
            document.getElementById('verifikasi-modal').classList.add('hidden');
        }
    </script>
@endsection
