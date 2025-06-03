@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container sm:px-10 sm:py-5 w-full h-auto flex flex-col gap-8">
        <div class="--warnging-alert w-fit p-2 rounded-lg bg-green-500/20 flex items-center gap-2">
            <div class="--icon"><i class="text-green-500 bi bi-exclamation-diamond-fill"></i></div>
            <p class="text-[14px] font-medium text-green-500">Detail Transaksi Offline</p>
        </div>
        <div class="--component-grid grid xl:grid-cols-2 gap-4">
            <div class="--component-1 flex flex-col gap-6">
                <div class="--information-user-order">
                    <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                        <div class="--header xl:text-[20px] font-bold">Informasi Client</div>
                        <div class="--body flex flex-col gap-4">
                            <div class="--foto-name-nomor-jenis-kalmin flex items-center justify-between">
                                <div class="--foto-name flex items-center gap-2">
                                    <img class="min-w-[40px] min-h-[40px] rounded-lg max-w-[60px] max-h-[60px] object-cover"
                                        src="{{ asset('assets/image/customers/profile/man.png') }}" alt="">
                                    <div class="--name font-medium">
                                        <p class="xl:text-[14px] text-gray-300">Nama Lengkap:</p>
                                        <p class="xl:text-[16px]">{{ $penyewaan->nama_penyewa }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="--alamat">
                                <p class="font-medium xl:text-[16px] mb-1">Alamat</p>
                                <p>{{ $penyewaan->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="--informasi-penyewaan">
                    <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                        <div class="--header xl:text-[20px] font-bold">Informasi Penyewaan</div>
                        <div class="--body">
                            <div class="--tanggal-mulai-selesai-status grid xl:grid-cols-3 items-center gap-4 mb-4">
                                <div class="--tanggal-mulai p-2 bg-green-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-calendar-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Tanggal Mulai:</p>
                                        <p class="text-[14px] font-bold">
                                            {{ Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="--tanggal-selesai p-2 bg-red-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-calendar-check-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Tanggal Selesai:</p>
                                        <p class="text-[14px] font-bold">
                                            {{ Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="--tanggal-selesai p-2 bg-orange-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-alarm-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Status:</p>
                                        <p class="text-[14px] font-bold">{{ $penyewaan->status_penyewaan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="--pesan p-2 rounded-lg flex gap-2 shadow-box-shadow-4">
                                <div><i class="bi bi-chat-square-quote-fill"></i></div>
                                <div>
                                    <p class="text-[12px] font-medium">Pesan:</p>
                                    <p class="text-[14px] font-bold">{{ $penyewaan->pesan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="--pembayaran-penyewaan">
                    <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                        <div class="--header xl:text-[20px] font-bold ">Informasi Pembayaran</div>
                        <div class="--body">
                            <div class="--wrapper-list-data grid grid-cols-3">
                                {{-- <div class="--bukti-pembayaran p-2 rounded-lg flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Bukti Pembyaran:</p>
                                    <img class="w-full object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/pembayaran/') }}" alt="Bukti Jaminan">
                                </div> --}}
                                <div class="--bukti-jaminan p-2 rounded-lg flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Jaminan</p>
                                    <p class="font-black -mt-2 text-[20px]">
                                        {{ $penyewaan->pembayaran->jaminan_sewa }}</p>
                                </div>
                                <div class="--bukti-pembayaran p-2 rounded-lg  flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Total Pembayaran:</p>
                                    <p class="font-black -mt-2 text-[20px]">Rp.
                                        {{ number_format($penyewaan->pembayaran->total_pembayaran, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="--component-2">
                <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                    <div class="--header xl:text-[20px] font-bold ">Informasi Barang</div>
                    <div class="--body flex flex-col gap-4">
                        <div class="--wrapper-card flex flex-col gap-2 p-2 rounded-lg shadow-box-shadow-4">
                            @foreach ($penyewaan->details as $detail)
                                @php
                                    $produk = $detail->produk;
                                @endphp
                                <div class="--image flex items-center gap-2 mb-4">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->foto_depan) }}"
                                        alt="Depan">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->foto_kanan) }}"
                                        alt="Kanan">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->foto_kiri) }}"
                                        alt="Kiri">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->foto_belakang) }}"
                                        alt="Belakang">
                                </div>
                                <div class="--name-kategori flex items-center gap-1">
                                    <p class="text-[20px] font-medium">{{ $produk->nama }}</p>
                                    <p class="p-1 rounded-lg bg-green-500/20 text-[10px] font-bold text-green-500">
                                        {{ $produk->kategori }}</p>
                                </div>
                            @endforeach
                            <div class="--name-kategori flex items-center gap-1">
                                <p class="text-[20px] font-medium"></p>
                                <p class="p-1 rounded-lg bg-green-500/20 text-[10px] font-bold text-green-500">
                                </p>
                            </div>
                            <div class="--variant-barang-dipesan flex flex-col gap-4">
                                <p class="text-[12px] font-medium">Informasi variant barang dipesan.</p>
                                <div class="--variant-barang">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Warna</th>
                                                <th>Ukuran</th>
                                                <th>Jumlah Dipesan</th>
                                                <th>Subtotal</th>
                                                @if ($penyewaan->status_penyewaan === 'aktif')
                                                    <th class="text-left py-2 px-4">Denda</th>
                                                    <th class="text-left py-2 px-4">Keterangan</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penyewaan->details as $detail)
                                                <tr>
                                                    <td class="text-[14px] font-medium">{{ $detail->warna_produk }}</td>
                                                    <td class="text-[14px] font-medium">{{ $detail->ukuran }}</td>
                                                    <td class="text-[14px] font-medium">{{ $detail->qty }}</td>
                                                    <td class="text-[14px] font-medium">
                                                        Rp.{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="text-left text-[16px] font-medium">Total
                                                </td>
                                                <td colspan="" class="text-[16px] text-left font-medium">Rp.
                                                    {{ number_format($penyewaan->pembayaran->total_pembayaran, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($penyewaan->status_penyewaan === 'aktif')
            <div class="--component-terima shadow-box-shadow-8 p-4 rounded-lg">
                <p class="font-medium text-[14px] mb-2 text-center">
                    Jika dirasa sudah memenuhi anda maka tekan tombol terima
                    dibawah ini, dan client anda akan memiliki status selesai.
                </p>
                <form id="form-confirm-order" action="{{ route('penyewaan.terima', $penyewaan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex justify-center">
                        <button id="terima-order"
                            class="p-3 w-1/2 rounded-full bg-[#F6D91F] border-black border-2 font-medium text-black">
                            Terima Pengembalian Client
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection
