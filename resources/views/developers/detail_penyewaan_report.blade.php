@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="--container w-full h-full p-6 flex flex-col gap-6">
        <!-- Header -->
        <!-- Header -->
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-bold text-gray-800">Detail Penyewaan</h1>
            <a href="{{ url('developer/dashboard/report/' . $status) }}"
                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded w-max">
                Kembali
            </a>

        </div>


        <!-- Informasi Penyewaan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Penyewaan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kolom 1 -->
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Nama Penyewa</p>
                        <p class="text-gray-800 mt-1">{{ $penyewaan->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Tanggal Mulai</p>
                        <p class="text-gray-800 mt-1">
                            {{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jenis Penyewaan</p>
                        <p class="text-gray-800 mt-1 capitalize">{{ $penyewaan->jenis_penyewaan }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Bukti Pembayaran</p>
                        @if ($penyewaan->pembayaran->bukti_pembayaran == 'Belum di isi')
                            <p class="text-gray-800 mt-1">-</p>
                        @else
                            <a href="{{ asset('assets/image/customer/pembayaran' . $penyewaan->pembayaran->bukti_pembayaran) }}"
                                target="_blank" class="text-blue-600 hover:underline mt-1 inline-block">
                                Lihat Bukti
                            </a>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Pembayaran</p>
                        <p class="text-gray-800 mt-1">Rp
                            {{ number_format($penyewaan->pembayaran->total_pembayaran, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Kolom 2 -->
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Tanggal Selesai</p>
                        <p class="text-gray-800 mt-1">
                            {{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Status Penyewaan</p>
                        <span
                            class="px-2 py-1 rounded-full text-xs mt-1 inline-block
                        @if ($penyewaan->status_penyewaan == 'aktif') bg-green-100 text-green-800
                        @elseif($penyewaan->status_penyewaan == 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                            {{ $penyewaan->status_penyewaan }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jaminan Sewa</p>
                        @if ($penyewaan->pembayaran->jaminan_sewa == 'Belum di isi')
                            <p class="text-gray-800 mt-1">-</p>
                        @else
                            <a href="{{ asset('assets/image/customer/jaminan' . $penyewaan->pembayaran->jaminan_sewa) }}"
                                target="_blank" class="text-blue-600 hover:underline mt-1 inline-block">
                                Lihat Jaminan
                            </a>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jumlah Pembayaran</p>
                        <p class="text-gray-800 mt-1">Rp
                            {{ number_format($penyewaan->pembayaran->jumlah_pembayaran, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Status Pembayaran</p>
                        <span
                            class="px-2 py-1 rounded-full text-xs mt-1 inline-block
                        @if ($penyewaan->pembayaran->status_pembayaran == 'lunas') bg-green-100 text-green-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                            {{ $penyewaan->pembayaran->status_pembayaran }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Produk -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex-1 flex flex-col">
            <h2 class="text-lg font-semibold text-gray-800 p-6 pb-4 border-b border-gray-200">Detail Produk Disewa</h2>
            <div class="flex-1 overflow-auto p-6 pt-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Warna</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ukuran</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($penyewaan->details as $detail)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $detail->produk->nama_produk ?? '-' }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $detail->warna_produk }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $detail->ukuran }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $detail->qty }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .--container {
            height: calc(100vh - 120px);
            /* Sesuaikan dengan tinggi header/navbar */
        }

        .min-w-full {
            min-width: 100%;
        }
    </style>
@endsection
