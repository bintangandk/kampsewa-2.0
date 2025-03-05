@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container sm:flex sm:flex-col sm:gap-8 w-full h-auto px-6 py-5 sm:px-8 sm:py-5">
        <div class="--title">
            <h1 class="xl:text-[28px] font-black">Menu Sewa Pelanggan Berlangsung.</h1>
        </div>
        <div class="--action flex xl:items-center w-full xl:justify-between">
            <ul class="--menu flex wrap gap-4 items-center">
                <li><a class="{{ $title === 'Order Masuk' ? 'border-b-2 border-b-[#FF3F42] text-[#FF3F42]' : '' }} hover:border-b-2 hover:border-b-[#FF3F42] hover:text-[#FF3F42] p-2 xl:text-[16px] font-medium text-[#D1CDD0]"
                        href="{{ route('menu-transaksi.index', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Order
                        Masuk</a></li>
                <li><a class="{{ $title === 'Sewa Berlangsung' ? 'border-b-2 border-b-[#FF3F42] text-[#FF3F42]' : '' }} hover:border-b-2 hover:border-b-[#FF3F42] hover:text-[#FF3F42] p-2 xl:text-[16px] font-medium text-[#D1CDD0]"
                        href="{{ route('menu-transaksi.sewa-berlangsung', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Sewa
                        Berlangsung</a></li>
                {{-- <li><a class="{{ $title === 'Denda' ? 'border-b-2 border-b-[#FF3F42] text-[#FF3F42]' : '' }} hover:border-b-2 hover:border-b-[#FF3F42] hover:text-[#FF3F42] p-2 xl:text-[16px] font-medium text-[#D1CDD0]"
                        href="{{ route('menu-transaksi.denda-transaksi', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Denda</a></li> --}}
                <li><a class="{{ $title === 'Selesai Order' ? 'border-b-2 border-b-[#FF3F42] text-[#FF3F42]' : '' }} hover:border-b-2 hover:border-b-[#FF3F42] hover:text-[#FF3F42] p-2 xl:text-[16px] font-medium text-[#D1CDD0]"
                        href="{{ route('menu-transaksi.order-selesai', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Selesai</a></li>
            </ul>
            <div class="--filter flex items-center gap-6">
                <form method="GET"
                    action="{{ route('menu-transaksi.sewa-berlangsung', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">
                    <div class="--filter-search relative flex">
                        <input type="search" value="{{ $search }}" name="search"
                            class="shadow-box-shadow-11 rounded-lg bg-white appearance-none px-6 py-2"
                            placeholder="Cari nama...enter" aria-label="Search" id="exampleFormControlInput3"
                            aria-describedby="button-addon3" />
                    </div>
                </form>
                <form method="GET"
                    action="{{ route('menu-transaksi.sewa-berlangsung', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                    id="form_filter_tanggal">
                    <div class="--filter-tanggal flex xl:items-center xl:gap-4">
                        <div class="--tangga-awal">
                            <input id="tanggal_awal" type="date"
                                class="shadow-box-shadow-11 cursor-pointer rounded-lg bg-white appearance-none px-6 py-2">
                        </div>
                        <div class="bg-[#191919] w-[3px] h-[15px] rounded-full rotate-90"></div>
                        <div class="--tangga-akhir">
                            <input id="tanggal_akhir" type="date"
                                class="shadow-box-shadow-11 cursor-pointer rounded-lg bg-white appearance-none px-6 py-2">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="--warnging-alert w-fit p-2 rounded-lg bg-orange-500/20 flex items-center gap-2">
            <div class="--icon"><i class="text-orange-500 bi bi-exclamation-diamond-fill"></i></div>
            <p class="text-[14px] font-medium text-orange-500">Disini anda hanya dapat melihat siapa saja pelanggan yang
                menyewa peralatan anda waktu penyewaan sedang berlangsung, anda bisa melihat detailnya dengan menekan tombol
                <b>Detail</b>
            </p>
        </div>
        <div class="--table bg-white w-full">
            <table class="w-full bg-white border-spacing-2">
                <thead class="bg-white sticky top-0 z-20 shadow-box-shadow-11">
                    <tr class="text-left">
                        <th class="px-4 py-2">Client</th>
                        <th class="px-4 py-2">Tanggal Dimulai</th>
                        <th class="px-4 py-2">Tanggal Selesai</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Pembayaran</th>
                        <th class="px-4 py-2">Metode</th>
                        <th class="px-4 py-2">Produk</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td colspan="7" style="height: 15px;"></td>
                    </tr>
                    @foreach ($data as $item)
                        <tr
                            class="shadow-box-shadow-8 p-2 hover:scale-105 hover:z-10 text-xs transition transform duration-200 text-[14px] font-medium">
                            <td class="px-4 py-2 flex items-center gap-2">
                                <img class="w-[40px] h-[40px] rounded-[10px] object-cover"
                                    src="{{ $item->foto_users != null ? asset('assets/image/customers/profile/' . $item->foto_users) : asset('assets/image/developers/agung-kurniawan.jpg') }}"
                                    alt="">
                                <div>{{ $item->nama_penyewa }}</div>
                            </td>
                            <td class="px-4 py-2">{{ Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }}</td>
                            <td class="px-4 py-2">{{ Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</td>
                            <td class="px-4 py-2">
                                <p class="py-1 px-2 rounded-md bg-green-500/20 text-green-900 text-center">
                                    {{ $item->status_penyewaan }}</p>
                            </td>
                            <td class="px-4 py-2">
                                <p
                                    class="py-1 px-2 rounded-md {{ $item->status_pembayaran == 'Belum lunas' ? 'bg-red-500/20 text-red-900' : '' }} bg-green-500/20 text-green-900 text-center">
                                    {{ $item->status_pembayaran }}</p>
                            </td>
                            <td class="px-4 py-2">{{ $item->metode }}</td>
                            <td class="px-4 py-2 flex items-center gap-2">
                                <img class="w-[40px] h-[40px] rounded-[10px] object-cover"
                                    src="{{ asset('assets/image/customers/produk/' . $item->foto_depan) }}" alt="">
                                <div class="max-w-[250px] line-clamp-1">{{ $item->nama }}</div>
                            </td>
                            <td class="px-4 py-2"><a
                                    href="{{ route('menu-transaksi.terima-order-masuk', ['id_penyewaan' => Crypt::encrypt($item->id_penyewaan)]) }}"
                                    class="py-1 px-2 rounded-md bg-orange-500/20 text-orange-900 text-center hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" style="height: 15px;"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil nilai dari query string jika tersedia
            var filterTglAwal = "{{ request()->input('tanggal_awal') }}";
            var filterTglAkhir = "{{ request()->input('tanggal_akhir') }}";
            var searchQuery = "{{ request()->input('search') }}";

            // Set nilai input tanggal saat halaman dimuat
            document.getElementById('tanggal_awal').value = filterTglAwal || '';
            document.getElementById('tanggal_akhir').value = filterTglAkhir || '';

            // Set nilai input search saat halaman dimuat
            if (searchQuery) {
                document.querySelector('input[name="search"]').value = searchQuery;
            }

            // Event listener untuk input tanggal_awal
            document.getElementById('tanggal_awal').addEventListener('change', function() {
                submitForm();
            });

            // Event listener untuk input tanggal_akhir
            document.getElementById('tanggal_akhir').addEventListener('change', function() {
                submitForm();
            });

            // Fungsi untuk men-submit form
            function submitForm() {
                // Ambil nilai dari input tanggal_awal, tanggal_akhir dan search
                var tanggalAwal = document.getElementById('tanggal_awal').value;
                var tanggalAkhir = document.getElementById('tanggal_akhir').value;
                var search = document.querySelector('input[name="search"]').value;

                // Bangun URL dengan parameter query yang sesuai
                var url = window.location.pathname + '?'; // Ambil path URL saat ini
                if (tanggalAwal) {
                    url += 'tanggal_awal=' + tanggalAwal + '&';
                }
                if (tanggalAkhir) {
                    url += 'tanggal_akhir=' + tanggalAkhir + '&';
                }
                if (search) {
                    url += 'search=' + encodeURIComponent(search);
                }

                // Redirect halaman dengan URL yang baru dibangun
                window.location.href = url;
            }

            // Event listener untuk input search
            document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitForm();
                }
            });

            // Update the form action when the search button is clicked
            document.getElementById('button-addon3').addEventListener('click', function() {
                submitForm();
            });
        });
    </script>
@endsection
