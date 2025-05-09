@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container px-10 py-5 w-full h-auto flex flex-col mobile-max:px-5 mobile-max:py-5 gap-4">
        <div class="--header">
            <h2 class="az-dashboard-title">Hi, Selamat Pagi {{ session('nama_lengkap') }}</h2>
            <p class="az-dashboard-text">Lihat dahulu informasi dashboard anda.</p>
        </div>
        <div class="--component-awal grid grid-cols-2 gap-4 w-full h-auto mobile-max:grid-cols-1">
            <div class="--chart-pemasukan-perbandingan-tahunini-tahunsebelumnya w-full">
                <div class="--design w-full">
                    <div class="--card shadow-box-shadow-8 p-4 rounded-[15px] bg-white w-full flex flex-col gap-4">
                        <div class="--header flex flex-col gap-2">
                            <div class="--title-btn flex items-center justify-between">
                                <div class="--title text-[16px] font-medium">Total Pemasukan Pertahun</div>
                                <div class="--icon"><i class="text-[16px] bi bi-three-dots"></i></div>
                            </div>
                            <div class="--total-nominal flex items-center gap-6">
                                <div class="--tahun-ini">
                                    <p class="text-[14px] text-[#808995]">Tahun Kemarin - {{ date('Y') - 1 }}</p>
                                    <p class="text-[18px] small-desktop:text-[16px] mobile-max:font-medium font-bold">Rp.
                                        {{ number_format($totalKemarin, 0, ',', '.') }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        {{-- <p
                                            class="p-1 rounded-full bg-[#D8EDDC] w-[22px] h-[22px] flex items-center justify-center">
                                            <i class="text-[#00823E] text-[16px] font-bold bi bi-arrow-up-short"></i>
                                        </p> --}}
                                        {{-- <p class="text-[#00823E] text-[14px] font-medium">+20.5%</p> --}}
                                    </div>

                                </div>
                                <div class="--tahun-sebelumnya">
                                    <p class="text-[14px] text-[#808995]">Tahun Saat ini - {{ date('Y') }}</p>
                                    <p class="text-[18px] small-desktop:text-[16px] mobile-max:font-medium font-bold">Rp.
                                        {{ number_format($totalSekarang, 0, ',', '.') }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        {{-- <p
                                            class="p-1 rounded-full bg-[#D8EDDC] w-[22px] h-[22px] flex items-center justify-center">
                                            <i class="text-[#00823E] text-[16px] font-bold bi bi-arrow-up-short"></i>
                                        </p> --}}
                                        {{-- <p class="text-[#00823E] text-[14px] font-medium">+14.5%</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="--body w-full">
                            <canvas id="customer-chart-pemasukan-dsb"></canvas>
                        </div>
                        <div class="--footer flex items-center gap-4">
                            <div class="--label-tahun-kemarin flex items-center gap-1">
                                <div class="w-[20px] h-[20px] bg-[rgb(86,11,208)] rounded-full"></div>
                                <p class="text-[14px] font-medium">Tahun Kemarin</p>
                            </div>
                            <div class="--label-tahun-kemarin flex items-center gap-1">
                                <div class="w-[20px] h-[20px] bg-[rgb(3,118,253)] rounded-full"></div>
                                <p class="text-[14px] font-medium">Tahun Saat ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="--chart-pemasukan-perbandingan-bulanini-bulansebelumnya w-full">
                <div class="--design w-full">
                    <div class="--card shadow-box-shadow-8 p-4 rounded-[15px] bg-white w-full flex flex-col gap-4">
                        <div class="--header flex flex-col gap-2">
                            <div class="--title-btn flex items-center justify-between">
                                <div class="--title text-[16px] font-medium">Total Pemasukan Perbulan</div>

                                <div class="--icon"><i class="text-[16px] bi bi-three-dots"></i></div>
                            </div>
                            <div class="--total-nominal flex items-center gap-6">
                                <div class="--tahun-ini">
                                    <p class="text-[14px] text-[#808995]">Bulan Kemarin -
                                        {{ date('F', mktime(0, 0, 0, date('m') - 1, 1)) }}</p>
                                    <p class="text-[18px] small-desktop:text-[16px] mobile-max:font-medium font-bold">Rp.
                                        {{ number_format($totalKemarinbulanlalu, 0, ',', '.') }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        {{-- <p
                                            class="p-1 rounded-full bg-[#D8EDDC] w-[22px] h-[22px] flex items-center justify-center">
                                            <i class="text-[#00823E] text-[16px] font-bold bi bi-arrow-up-short"></i> --}}
                                        </p>
                                        <p class="text-[#00823E] text-[14px] font-medium"></p>
                                    </div>
                                </div>
                                <div class="--tahun-sebelumnya">
                                    <p class="text-[14px] text-[#808995]">Bulan Saat ini - {{ date('F') }}</p>
                                    <p class="text-[18px] small-desktop:text-[16px] mobile-max:font-medium font-bold">Rp.
                                        {{ number_format($totalSekarangbulanini, 0, ',', '.') }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        {{-- <p
                                            class="p-1 rounded-full bg-[#D8EDDC] w-[22px] h-[22px] flex items-center justify-center">
                                            <i class="text-[#00823E] text-[16px] font-bold bi bi-arrow-up-short"></i>
                                        </p> --}}
                                        {{-- <p class="text-[#00823E] text-[14px] font-medium">+14.5%</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="--body w-full">
                            <canvas id="customer-chart-pemasukan-perbulan-dsb"></canvas>
                        </div>
                        <div class="--footer flex items-center gap-4">
                            <div class="--label-tahun-kemarin flex items-center gap-1">
                                <div class="w-[20px] h-[20px] bg-[#FFCE56] rounded-full"></div>
                                <p class="text-[14px] font-medium">Bulan Kemarin</p>
                            </div>
                            <div class="--label-tahun-kemarin flex items-center gap-1">
                                <div class="w-[20px] h-[20px] bg-[#4BC0C0] rounded-full"></div>
                                <p class="text-[14px] font-medium">Bulan Saat Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="--component-keduua w-full flex flex-col gap-4">
            <div class="--title w-full flex items-center justify-between">
                <p class="text-[22px] font-medium">Peralatan Terlaris</p>
                {{-- <p><a href="" class="text-[14px] text-blue-400 underline">Lihat Semua</a></p> --}}
            </div>
            <div class="--wrapper-card w-full grid grid-cols-5 gap-2 mobile-max:grid-cols-2">


                @if (count($peralatanTerlaris) == 0)
                    <div class="--card">
                        <div class="block bg-white shadow-box-shadow-8 rounded-[15px] overflow-hidden dark:bg-surface-dark">
                            {{-- <a href="#!">
                                <img src="{{ asset('assets/image/customers/produk/empty.png') }}" alt=""
                                    style="width: 250px; height: 200px; object-fit: cover;" />

                            </a> --}}
                            <div class="p-2 text-surface dark:text-white">
                                <h5 class="mb-2 text-[16px] small-desktop:line-clamp-1 font-medium leading-tight">
                                    Tidak ada produk terlaris</h5>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($peralatanTerlaris as $item)
                        <div class="--card">
                            <div
                                class="block bg-white shadow-box-shadow-8 rounded-[15px] overflow-hidden dark:bg-surface-dark">
                                <a href="#!">
                                    {{-- @dump($item->produk->id) --}}
                                    <img src="{{ asset('assets/image/customers/produk/' . $item->produk->foto_depan) }}"
                                        alt="" style="width: 250px; height: 200px; object-fit: cover;" />

                                </a>
                                <div class="p-2 text-surface dark:text-white">
                                    <h5 class="mb-2 text-[16px] small-desktop:line-clamp-1 font-medium leading-tight">
                                        {{ $item->produk->nama }}</h5>
                                    <p class="text-[12px] line-clamp-3 small-desktop:line-clamp-2">
                                        {{ $item->produk->deskripsi }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div
            class="--component-ketiga w-full h-auto small-desktop:grid-cols-2 grid grid-cols-3 gap-4 mobile-max:grid-cols-1">
            <div class="--card-user-sewa-berlangsung p-4 shadow-box-shadow-11 flex flex-col justify-start rounded-[15px]">
                <div class="--header mb-4">
                    <h1 class="text-[22px] font-medium">Penyewa Berlangsung</h1>
                    <p class="text-[14px]">Penyewa yang sedang berlangsung dan aktif saat ini.</p>
                </div>

                <div class="--list-item flex flex-col gap-2">

                    @if (count($penyewaAktif) == 0)
                        <div class="--card p-2 bg-[#F9F9F9] rounded-[15px] flex items-center justify-between">
                            <div class="--bagian-1 flex items-center gap-4">
                                <div class="--image">
                                    <img class="rounded-[15px] w-[50px] h-[50px] object-cover"
                                        src="{{ asset('assets/image/customers/produk/empty.png') }}" alt="">
                                </div>
                                <div class="--title">
                                    <p class="text-[14px] font-bold">Tidak ada penyewa aktif</p>
                                </div>
                            </div>
                            <div class="--bagian-2">
                                <p class="text-[12px] font-medium py-1 px-2 bg-[#FFCE56] rounded-full">Berlangsung</p>
                            </div>
                        </div>
                    @else
                        @foreach ($penyewaAktif as $item)
                            <div class="--card p-2 bg-[#F9F9F9] rounded-[15px] flex items-center justify-between">
                                <div class="--bagian-1 flex items-center gap-4">
                                    <div class="--image">
                                        <img class="rounded-[15px] w-[50px] h-[50px] object-cover"
                                            src="{{ asset('assets/image/profile/' . $item->user->foto) }}" alt="">
                                    </div>
                                    <div class="--title">
                                        <p class="text-[14px] font-bold">{{ $item->user->name }}</p>
                                    </div>
                                </div>
                                <div class="--bagian-2">
                                    <p class="text-[12px] font-medium py-1 px-2 bg-[#FFCE56] rounded-full">Berlangsung</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{-- <p class="text-center w-full">
                        <a href="" class="text-[14px] font-medium hover:underline">6 Penyewa Lainnya...</a>
                    </p> --}}
                </div>
            </div>

            <div class="p-4 bg-white rounded-[15px] shadow-md">
                <div class="--header mb-4">
                    <h1 class="text-[22px] font-medium">Riwayat Penyewa</h1>
                    <p class="text-[14px]">Riwayat penyewa yang telah selesai.</p>
                </div>


                <div class="flex flex-col gap-2">
                    @if (count($penyewaSelesai) == 0)
                        <div class="p-2 bg-[#F9F9F9] rounded-[15px] flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div>
                                    <img class="rounded-[15px] w-[50px] h-[50px] object-cover"
                                        src="{{ asset('assets/image/customers/produk/empty.png') }}" alt="Empty">
                                </div>
                                <div>
                                    <p class="text-[14px] font-bold">Belum ada penyewa</p>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($penyewaSelesai as $item)
                            <div class="p-2 bg-[#F9F9F9] rounded-[15px] flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="--image">
                                        <img class="rounded-[15px] w-[50px] h-[50px] object-cover"
                                            src="{{ asset('assets/image/profile/' . $item->user->foto) }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <p class="text-[14px] font-bold text-[#001D6E]">{{ $item->user->name }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[12px] font-medium py-1 px-2 bg-[#00823E] text-white rounded-full">
                                        Selesai</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div
                class="--card-user-sewa-berlangsung p-4 shadow-box-shadow-11 flex flex-col justify-between rounded-[15px]">
                <div class="--header">
                    <h1 class="text-[22px] font-medium">Denda Penyewa</h1>
                    <p class="text-[14px] mb-4">Penyewa terkena denda Terlambat dari penyewaan yang sedang berlangsung.</p>
                </div>
                <div class="--list-item flex flex-col gap-2">
                    @forelse ($penyewaTelat as $sewa)
                        <div class="--card p-2 bg-[#F9F9F9] rounded-[15px] flex items-center justify-between">
                            <div class="--bagian-1 flex items-center gap-4">
                                <div class="--image">
                                    <!-- Foto profil user (contoh: ambil dari relasi user) -->
                                    <img class="rounded-[15px] w-[50px] h-[50px] object-cover"
                                        src="{{ asset($sewa->user->foto_profil ?? 'assets/image/default-avatar.jpg') }}"
                                        alt="Foto {{ $sewa->user->name }}">
                                </div>
                                <div class="--title">
                                    <p class="text-[14px] font-bold">{{ $sewa->user->name }}</p>
                                    <p class="text-[12px] line-clamp-1">
                                        {{ $sewa->details->first()->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                    </p>
                                </div>
                            </div>
                            <div class="--bagian-2">
                                <p
                                    class="text-[12px] font-medium small-desktop:text-[10px] py-1 px-2 bg-[#F04444] text-white rounded-full whitespace-nowrap">
                                    {{ $sewa->hari_telat }} Hari
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Tidak ada penyewa yang telat saat ini.</p>
                    @endforelse

                    <!-- Tautan "Lihat Semua" (jika data lebih dari 5) -->
                    @if ($penyewaTelat->count() > 5)
                        <p class="text-center w-full">
                            <a href="{{ route('denda.index') }}" class="text-[14px] font-medium hover:underline">
                                {{ $penyewaTelat->count() - 5 }} Penyewa Lainnya...
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
