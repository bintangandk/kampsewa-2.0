@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container sm:flex sm:flex-col sm:gap-8 w-full h-auto px-6 py-5 sm:px-8 sm:py-5">
        <div class="--title">
            <h1 class="xl:text-[28px] font-black">Menu Transaksi Offline Selesai</h1>
        </div>
        <div class="--action flex xl:items-center w-full xl:justify-between">
            <ul class="--menu flex wrap gap-4 items-center">
                <li><a class="{{ $title === 'Order Offline' ? 'border-b-2 border-b-[#FF3F42] text-[#FF3F42]' : '' }} hover:border-b-2 hover:border-b-[#FF3F42] hover:text-[#FF3F42] p-2 xl:text-[16px] font-medium text-[#D1CDD0]"
                        href="{{ route('transaksi-offline.order-offline') }}">Sewa Berlangsung</a></li>
                <li><a class="{{ $title === 'Order Selesai' ? 'border-b-2 border-b-[#FF3F42] text-[#FF3F42]' : '' }} hover:border-b-2 hover:border-b-[#FF3F42] hover:text-[#FF3F42] p-2 xl:text-[16px] font-medium text-[#D1CDD0]"
                        href="{{ route('transaksi-offline.order-selesai', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Selesai</a>
                </li>
            </ul>
            <div class="--filter flex items-center gap-4">
                <form method="GET">
                    <div class="--filter-search relative flex">
                        <input type="search" value="#" name="search"
                            class="shadow-box-shadow-11 rounded-lg bg-white appearance-none px-6 py-2"
                            placeholder="Cari transaksi" aria-label="Search" id="exampleFormControlInput3"
                            aria-describedby="button-addon3" />
                    </div>
                </form>
                {{-- <form method="GET" id="form-filter-order-selesai">
                    <div class="--filter-tanggal flex xl:items-center xl:gap-4">
                        <div class="--filter-dropdown">
                            <div class="w-fit relative">
                                <select
                                    class="shadow-box-shadow-11 cursor-pointer rounded-lg bg-white appearance-none px-6 py-2"
                                    name="filter-order-selesai" id="filter-order-selesai">
                                    <option value="Semua">Semua</option>
                                    <option value="Pengembalian">Belum Dikonfirmasi</option>
                                    <option value="Selesai">Sudah Dikonfirmasi</option>
                                </select>
                                <i class="absolute right-2 top-1/2 transform -translate-y-1/2 bi bi-caret-down-fill"></i>
                            </div>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
        {{-- <div class="--warnging-alert w-fit p-2 rounded-lg bg-orange-500/20 flex items-center gap-2">
            <div class="--icon"><i class="text-orange-500 bi bi-exclamation-diamond-fill"></i></div>
            <p class="text-[14px] font-medium text-orange-500">Silahkan pilih tombol <b>ACC</b> untuk pelanggan yang
                melakukan pengembalian dan bisa di filter dengan memilih pilihan <b>Belum Dikonfirmasi</b>! dan anda bisa
                melihat riwayat transaksi yang sudah selesai dengan memilih filter
                <b>Sudah Dikonfirmasi</b>.
            </p>
        </div> --}}
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
                    @forelse($penyewaanSelesai as $item)
                        <tr
                            class="shadow-box-shadow-8 p-2 hover:scale-105 hover:z-10 text-xs transition transform duration-200 text-[14px] font-medium">
                            <td class="px-4 py-2 flex items-center gap-2">
                                <img class="w-[40px] h-[40px] rounded-[10px] object-cover"
                                    src="{{ asset('assets/image/customers/profile/man.png') }}" alt="">
                                <div>{{ $item->nama_penyewa ?? 'User' }}</div>
                            </td>
                            <td class="px-4 py-2">{{ Carbon\Carbon::parse($item->tgl_mulai)->format('d F Y') }}</td>
                            <td class="px-4 py-2">{{ Carbon\Carbon::parse($item->tgl_selesai)->format('d F Y') }}</td>
                            <td class="px-4 py-2">
                                <p class="py-1 px-2 rounded-md bg-amber-500/20 text-amber-900 text-center">
                                    {{ ucfirst($item->status_penyewaan) }}
                                </p>
                            </td>
                            <td class="px-4 py-2">
                                <p class="py-1 px-2 rounded-md  bg-green-500/20 text-green-900 text-center">
                                    {{ $item->pembayaran->metode ?? '-' }}
                                </p>
                            </td>
                            <td class="px-4 py-2">{{ $item->pembayaran->metode ?? '-' }}</td>
                            <td class="px-4 py-2 flex items-center gap-2">
                                <img class="w-[40px] h-[40px] rounded-[10px] object-cover"
                                    src="{{ asset('assets/image/customers/produk/') }}" alt="">
                                <div class="max-w-[250px] line-clamp-1"></div>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ url('customer/dashboard/detail-offline/' . $item->id) }}"
                                    class="py-1 px-2 rounded-md bg-blue-500/20 text-blue-900 text-center hover:text-blue-900">
                                    Detail
                                </a>
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
@endsection


