@extends('layouts.customers.layouts-customer')
@section('customer-content')
    @include('components.modals.tambah-pemasukan-cust')
    <div class="--container w-full h-auto px-6 py-6 md:px-10 md:py-10 flex flex-col gap-6">
        <div
            class="--heading w-full h-auto flex flex-col gap-6 md:gap-6 lg:gap-0 md:flex-col lg:flex-row md:justify-between md:items-center">
            <div class="--url-penghasilan-apengeluaran w-full flex items-center gap-4">
                <div class="--url-penghasilan"><a
                        href="{{ route('keuangan.index', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                        class="{{ $title == 'Menu Keuangan' ? 'text-[#6F65D6] bg-[#EEEDFA]' : '' }} p-2 font-medium rounded-lg">Penghasilan</a>
                </div>
                <div class="--url-pengeluaran"><a
                        href="{{ route('keuangan.pengeluaran-customer', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                        class="{{ $title == 'Menu Pengeluaran' ? 'text-[#6F65D6] bg-[#EEEDFA]' : '' }} p-2 font-medium rounded-lg">Pengeluaran</a>
                </div>
            </div>
            <div class="--filter-tahun-bulan-cetak w-full flex flex-col gap-4 sm:flex-row sm:flex sm:items-center sm:gap-2">
                <div class="--search w-full">
                    <form id="search-form" method="GET">
                        <div class="w-full flex justify-center">
                            <div class="relative w-full">
                                <input type="text" name="search" value="{{ $search }}"
                                    class="w-full backdrop-blur-sm bg-white/20 py-2 pl-10 pr-4 bg-white shadow-box-shadow-11 rounded-lg focus:outline-non focus:border-violet-300 transition-colors duration-300"
                                    placeholder="Cari nominal / deskripsi">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center cursor-pointer">
                                    <button id="cari-button" class="focus:outline-none">
                                        <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex items-centers gap-2">
                    <div class="--filter-tahun">
                        <form method="GET" id="filter-tahun-form">
                            <div class="w-fit relative">
                                <select
                                    class="shadow-box-shadow-11 cursor-pointer rounded-lg bg-white appearance-none px-6 py-2"
                                    name="filter_tahun" id="filter-tahun">
                                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                    <option value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                    <option value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                    <option value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                </select>
                                <i class="absolute right-2 top-1/2 transform -translate-y-1/2 bi bi-caret-down-fill"></i>
                            </div>
                        </form>
                    </div>
                    <div class="--filter-bulan">
                        <form method="GET" id="filter-bulan-form">
                            <div class="w-fit relative">
                                <select
                                    class="shadow-box-shadow-11 rounded-lg cursor-pointer bg-white appearance-none px-4 py-2"
                                    name="filter_bulan" id="filter-bulan">
                                    <option value="semua_bulan">Semua</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <i class="absolute right-2 top-1/2 transform -translate-y-1/2 bi bi-caret-down-fill"></i>
                            </div>
                        </form>
                    </div>
                    <div class="--filter-cetak">
                        <form
                            action="{{ route('keuangan.download-penghasilan', ['id_user' => session('id_user'), 'tahun' => $tahun]) }}">
                            <button class="px-4 py-2 bg-white rounded-lg shadow-box-shadow-11 flex items-center gap-2"><i
                                    class="bi bi-printer-fill"></i> Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="--card-information w-full grid lg:grid-cols-3 md:grid-cols-2 gap-4">
            <div class="--card-penghasilan-pertahun shadow-box-shadow-11 p-4 rounded-lg">
                <div class="--header">
                    <div class="--icon-title flex items-center gap-4">
                        <div class="--icon p-2 bg-[#F3F5F7] w-[34px] h-[34px] flex items-center justify-center rounded-lg">
                            <i class="bi bi-currency-exchange"></i>
                        </div>
                        <div class="--title font-medium text-[16px]">Penghasilan Pertahun - {{ $tahun }}</div>
                    </div>
                </div>
                <div class="--body flex items-center gap-2">
                    <div class="--nominal font-bold text-[20px] md:text-[20px] lg:text-[24px] xl:text-[28px]">Rp.
                        {{ number_format($total_tahun_sekarang, 0, ',', '.') }}</div>
                    @if ($persentase_pertahun > 0)
                        <div class="--persentase w-fit font-bold px-2 py-1 rounded-lg text-[#75D5CB] bg-[#E7F8F6]">
                            {{ number_format(abs($persentase_pertahun), 0) }}% <i class="bi bi-arrow-up-right"></i></div>
                    @else
                        <div class="--persentase w-fit font-bold px-2 py-1 rounded-lg bg-[#ffd1d1] text-[#ff6d6d]">
                            {{ number_format(abs($persentase_pertahun), 0) }}% <i class="bi bi-arrow-down-right"></i></div>
                    @endif
                </div>
            </div>
            <div class="--card-penghasilan-perbulan shadow-box-shadow-11 p-4 rounded-lg">
                <div class="--header">
                    <div class="--icon-title flex items-center gap-4">
                        <div class="--icon p-2 bg-[#F3F5F7] w-[34px] h-[34px] flex items-center justify-center rounded-lg">
                            <i class="bi bi-wallet-fill"></i>
                        </div>
                        <div class="--title font-medium text-[16px]">Penghasilan Perbulan - {{ date('M') }}</div>
                    </div>
                </div>
                <div class="--body flex items-center gap-2">
                    <div class="--nominal font-bold text-[20px] md:text-[20px] lg:text-[24px] xl:text-[28px]">Rp.
                        {{ number_format($total_perbulan, 0, ',', '.') }}
                    </div>
                    @if ($persentase_perbulan > 0)
                        <div class="--persentase w-fit font-bold px-2 py-1 rounded-lg text-[#75D5CB] bg-[#E7F8F6]">
                            {{ number_format(abs($persentase_perbulan), 0) }}% <i class="bi bi-arrow-up-right"></i></div>
                    @else
                        <div class="--persentase w-fit font-bold px-2 py-1 rounded-lg bg-[#ffd1d1] text-[#ff6d6d]">
                            {{ number_format(abs($persentase_perbulan), 0) }}% <i class="bi bi-arrow-down-right"></i></div>
                    @endif
                </div>
            </div>
            <div class="--card-penghasilan-keuntungan shadow-box-shadow-11 p-4 rounded-lg">
                <div class="--header">
                    <div class="--icon-title flex items-center gap-4">
                        <div class="--icon p-2 bg-[#F3F5F7] w-[34px] h-[34px] flex items-center justify-center rounded-lg">
                            <i class="bi bi-piggy-bank-fill"></i>
                        </div>
                        <div class="--title font-medium text-[16px]">Keuntungan</div>
                    </div>
                </div>
                <div class="--body flex items-center gap-2">
                    <div class="--nominal font-bold text-[20px] md:text-[20px] lg:text-[24px] xl:text-[28px]">Rp.
                        {{ number_format($keuntungan, 0, ',', '.') }}
                    </div>
                    @if ($persentase_keuntungan > 0)
                        <div class="--persentase w-fit font-bold px-2 py-1 rounded-lg text-[#75D5CB] bg-[#E7F8F6]">
                            {{ number_format(abs($persentase_keuntungan), 0) }}% <i class="bi bi-arrow-up-right"></i>
                        </div>
                    @else
                        <div class="--persentase w-fit font-bold px-2 py-1 rounded-lg bg-[#ffd1d1] text-[#ff6d6d]">
                            {{ number_format(abs($persentase_keuntungan), 0) }}% <i class="bi bi-arrow-down-right"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="--table bg-white flex flex-col gap-4">
            <div class="--action flex items-center gap-2">
                <div class="--button">
                    <button id="tambah-pemasukan-customer" class="gradient-1 text-white px-4 py-2 rounded-lg"><i
                            class="bi bi-plus-lg"></i> Tambah
                        Pemasukan</button>
                </div>
            </div>
            <div class="overflow-scroll px-0 w-full">
                <table class="w-full min-w-max table-auto text-left">
                    <thead>
                        <tr>
                            <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                <p
                                    class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                    Sumber</p>
                            </th>
                            <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                <p
                                    class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                    Deskripsi</p>
                            </th>
                            <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                <p
                                    class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                    Nominal</p>
                            </th>
                            <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                <p
                                    class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                    Tanggal</p>
                            </th>
                            <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                <p
                                    class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pemasukan as $item)
                            <tr>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="w-max">
                                        <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none bg-green-500/20 text-green-900 py-1 px-2 text-xs rounded-md"
                                            style="opacity: 1;">
                                            <span class="">{{ $item->sumber }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <p
                                        class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                        {{ $item->deskripsi }}</p>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <p
                                        class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                        Rp. {{ number_format($item->nominal, 0, ',', '.') }}</p>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col">
                                            <p>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50 flex">
                                    <a href="{{ route('keuangan.update-penghasilan', ['id_penghasilan' => Crypt::encrypt($item->id)]) }}"
                                        class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                                        type="button">
                                        <span
                                            class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true" class="h-4 w-4">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                    <form method="POST" id="form-delete-{{ $item->id }}"
                                        action="{{ route('keuangan.delete-penghasilan', ['id_penghasilan' => $item->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="btn-hapus-{{ $item->id }}"
                                            class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                                            type="button">
                                            <span
                                                class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" aria-hidden="true" class="h-4 w-4">
                                                    <path
                                                        d="M5.5 5.5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7zm3 0a.5.5 0 00-1 0v7a.5.5 0 001 0v-7zm3 0a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1.5 1a1 1 0 011-1h11a1 1 0 011 1V3H1V1zm11 1h-9v12a1 1 0 001 1h7a1 1 0 001-1V2zM4.5 0a.5.5 0 000 1H6a.5.5 0 000-1h-1.5zm6 0a.5.5 0 000 1H12a.5.5 0 000-1h-1.5z" />
                                                </svg>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simpan nilai filter_tahun dan filter_bulan saat halaman dimuat
            var filterTahunValue = "{{ request()->input('filter_tahun') }}";
            var filterBulanValue = "{{ request()->input('filter_bulan') }}";
            var searchValue = "{{ request()->input('search') }}";

            // Set nilai input select filter tahun dan bulan saat halaman dimuat
            document.getElementById('filter-tahun').value = filterTahunValue || "{{ date('Y') }}";
            document.getElementById('filter-bulan').value = filterBulanValue ||
                "semua_bulan"; // Ganti nilai default menjadi "semua_bulan"

            // Tombol submit pada form filter tahun
            document.getElementById('filter-tahun').addEventListener('change', function() {
                var filterTahunForm = document.getElementById('filter-tahun-form');
                var filterTahunValue = document.getElementById('filter-tahun').value;

                // Menyiapkan URL dengan parameter filter_tahun dan filter_bulan
                var url = '?' + new URLSearchParams(window.location.search).toString();
                url = updateQueryStringParameter(url, 'filter_tahun', filterTahunValue);

                // Mengambil nilai filter_bulan dari URL saat ini
                var filterBulanValue = "{{ request()->input('filter_bulan') }}";
                // Memeriksa apakah filter_bulan sudah ada pada URL
                if (filterBulanValue) {
                    url = updateQueryStringParameter(url, 'filter_bulan', filterBulanValue);
                }

                // Mengirimkan permintaan ke URL yang diperbarui
                window.location.href = url;
            });

            // Tombol submit pada form filter bulan
            document.getElementById('filter-bulan').addEventListener('change', function() {
                var filterBulanForm = document.getElementById('filter-bulan-form');
                var filterBulanValue = document.getElementById('filter-bulan').value;

                // Menyiapkan URL dengan parameter filter_bulan dan filter_tahun
                var url = '?' + new URLSearchParams(window.location.search).toString();
                url = updateQueryStringParameter(url, 'filter_bulan', filterBulanValue);

                // Mengambil nilai filter_tahun dari URL saat ini
                var filterTahunValue = "{{ request()->input('filter_tahun') }}";
                // Memeriksa apakah filter_tahun sudah ada pada URL
                if (filterTahunValue) {
                    url = updateQueryStringParameter(url, 'filter_tahun', filterTahunValue);
                }

                // Mengirimkan permintaan ke URL yang diperbarui
                window.location.href = url;
            });

            // Tombol submit pada form pencarian ketika tombol ditekan
            document.querySelector('.cari-button').addEventListener('click', function(event) {
                event.preventDefault();
                var searchQuery = document.getElementById('search').value;

                // Menyiapkan URL dengan parameter search
                var url = '?' + new URLSearchParams(window.location.search).toString();

                // Mengambil nilai filter_tahun dan filter_bulan dari URL saat ini
                var filterTahunValue = "{{ request()->input('filter_tahun') }}";
                var filterBulanValue = "{{ request()->input('filter_bulan') }}";

                // Memeriksa apakah filter_tahun dan filter_bulan sudah ada pada URL
                // Jika ada, tambahkan ke URL pencarian baru
                if (filterTahunValue) {
                    url = updateQueryStringParameter(url, 'filter_tahun', filterTahunValue);
                }
                if (filterBulanValue) {
                    url = updateQueryStringParameter(url, 'filter_bulan', filterBulanValue);
                }

                url = updateQueryStringParameter(url, 'search', searchQuery);

                // Mengirimkan permintaan ke URL yang diperbarui
                window.location.href = url;
            });

            // Fungsi untuk memperbarui parameter dalam URL
            function updateQueryStringParameter(uri, key, value) {
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }
        });

        const modal = document.getElementById('modal-tambah-pemasukan-customer');
        const idButton = document.getElementById('tambah-pemasukan-customer');
        const submitPemasukan = document.getElementById('tambah-pemasukan');
        const formTambahPemasukan = document.getElementById('form-tambah-pemasukan');
        const cancelButton = document.getElementById('cancel-tambah-pemasukan-web-customer');

        // Fungsi untuk menampilkan atau menyembunyikan modal
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
            let sumber = document.getElementById('sumber_pemasukan_customer').value.trim();
            let deskripsi = document.getElementById('deskripsi_pemasukan_customer').value.trim();
            let nominal = document.getElementById('nominal_pemasukan_customer').value.trim();

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

        document.querySelectorAll('[id^="btn-hapus-"]').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Data ini tidak akan kembali ketika dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus ini!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const penghasilanId = this.id.replace('btn-hapus-', '');
                        document.getElementById('form-delete-' + penghasilanId).submit();
                    } else {
                        Swal.fire('Dibatalkan', 'Penghapusan dibatalkan', 'info');
                    }
                });
            });
        });
    </script>
@endsection
