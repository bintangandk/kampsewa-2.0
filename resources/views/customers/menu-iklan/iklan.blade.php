@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container w-full mobile-max:px-6 mobile-max:py-2 px-10 py-5 h-auto">
        <div
            class="--wrapper-card-main-wrapper-card-get-manajemen-iklan w-full grid grid-cols-[2fr_1fr] small-desktop:grid-cols-1 gap-6">
            <div class="--card-main w-full flex flex-col gap-10">
                <div
                    class="--card-design mobile-max:flex-col flex relative justify-content-between items-center w-full mobile-max:h-auto mobile-max:gap-4 h-[300px] bg-white shadow-box-shadow-11 rounded-[30px] p-4">
                    <div class="--header w-full flex flex-col gap-4 items-start">
                        <h1 class="text-[34px] font-black">Iklankan<br>Peralatan Kamping!</h1>
                        <p class="text-[14px]">Ingin menjangkau lebih banyak penyewa di area sekitar anda? anda bisa! dengan
                            cara promosikan peralatan kamping dengan harga promosi iklan yang terjangkau dan yang pasti
                            mencapai semua pengguna.</p>
                        <div class="mt-2"><a
                                href="{{ route('pilih-durasi-iklan.index', ['id_user' => Crypt::encryptString(session('id_user'))]) }}"
                                class="text-[14px] bg-gradient-to-bl from-[#B381F4] to-[#5038ED] text-white rounded-[10px] p-[10px] hover:bg-gradient-to-t hover:from-[#B381F4] hover:to-[#5038ED]">Mulai
                                Buat Iklan!</a></div>
                    </div>
                    <div class="--body w-full">
                        <img class="w-[400px] h-auto object-cover"
                            src="{{ asset('images/illustration/Get-A-Job-Promotion--Streamline-Manila.png') }}"
                            alt="">
                    </div>
                </div>
                <div class="--card-informasi-kedua w-full mobile-max:flex-col flex items-center">
                    <div class="--blok-image w-full h-[400px] relative">
                        <img class="w-[40px] bottom-40 left-[-20px] absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval.png') }}" alt="">
                        <img class="w-[40px] top-36 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (1).png') }}" alt="">
                        <img class="w-[40px] top-24 left-[-10px] absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (2).png') }}" alt="">
                        <img class="w-[40px] left-14 top-20 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (3).png') }}" alt="">
                        <img class="w-[40px] top-16 left-28 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (4).png') }}" alt="">
                        <img class="w-[40px] left-40 top-20 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (5).png') }}" alt="">
                        <img class="w-[40px] left-52 top-20 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (6).png') }}" alt="">
                        <img class="w-[40px] left-72 top-28 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (7).png') }}" alt="">
                        <img class="w-[40px] left-64 bottom-28 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (8).png') }}" alt="">
                        <img class="w-[40px] left-72 bottom-40 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (9).png') }}" alt="">
                        <img class="w-[40px] left-20 bottom-10 absolute object-cover animate-float"
                            src="{{ asset('images/illustration/Oval (10).png') }}" alt="">


                        <img class="w-[300px] absolute bottom-0 h-auto object-cover"
                            src="{{ asset('images/illustration/Designer-Working--Streamline-Manila.png') }}"
                            alt="">
                    </div>
                    <div class="--blok-deskripsi w-full">
                        <div class="--header font-black text-[34px]">Lebih Dari {{ $total_data_iklan }}+ User Menggunakan
                            Layanan Iklan.</div>
                    </div>
                </div>
            </div>
            <div class="--card-manajemen-iklan w-full flex flex-col gap-10">
                <div class="--btn-management flex flex-col gap-4">
                    <p class="text-[16px] font-bold">Kelola Data Iklan Anda!</p>
                    <div><a href="{{ route('kelola-iklan.index', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                            class="text-[14px] bg-gradient-to-bl from-[#B381F4] to-[#5038ED] text-white rounded-[10px] p-[10px] hover:bg-gradient-to-t hover:from-[#B381F4] hover:to-[#5038ED]">Kelola
                            Iklan</a></div>
                </div>

                <div class="--wrapper-card-iklan-sedang-berlangsung flex flex-col gap-4">
                    <p class="text-[16px] font-bold">Iklan Anda Yang Sedang Berlangsung.</p>
                    @foreach ($iklan_berlangsung as $item)
                        <div class="--card-design w-full flex items-center justify-between gap-2">
                            <div class="--header flex items-start gap-2">
                                <div class="--image"><img class="w-[60px] min-w-[60px] h-[60px] rounded-[10px] object-cover"
                                        src="{{ asset('assets/image/customers/advert/' . $item->poster) }}" alt="">
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium capitalize">{{ $item->judul }}</p>
                                    <p class="text-[12px] text-gray-400"><i class="bi bi-alarm-fill"></i>
                                        {{ $item->durasi_hari }} Hari</p>
                                </div>
                            </div>
                            <div class="--body font-black text-[14px] whitespace-nowrap text-green-500">
                                Rp. {{ number_format($item->harga_iklan, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="--wrapper-card-iklan-sedang-berlangsung flex flex-col gap-4">
                    <p class="text-[16px] font-bold">Iklan Anda Yang Menunggu Giliran.</p>
                    @foreach ($iklan_pending as $item)
                        <div class="--card-design w-full flex items-center justify-between gap-2">
                            <div class="--header flex items-start gap-2">
                                <div class="--image"><img class="w-[60px] min-w-[60px] h-[60px] rounded-[10px] object-cover"
                                        src="{{ asset('assets/image/customers/advert/' . $item->poster) }}" alt="">
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium">{{ $item->judul }}</p>
                                    <p class="text-[12px] text-gray-400"><i class="bi bi-alarm-fill"></i>
                                        {{ $item->durasi_hari }} Hari</p>
                                </div>
                            </div>
                            <div class="--body font-black text-[14px] whitespace-nowrap text-green-500">
                                Rp. {{ number_format($item->harga_iklan, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="--wrapper-card-iklan-sedang-berlangsung flex flex-col gap-4">
                    <p class="text-[16px] font-bold">Riwayat Terbaru Iklan Anda.</p>
                    @foreach ($iklan_selesai as $item)
                        <div class="--card-design w-full flex items-center justify-between gap-2">
                            <div class="--header flex items-start gap-2">
                                <div class="--image"><img class="w-[60px] min-w-[60px] h-[60px] rounded-[10px] object-cover"
                                        src="{{ asset('assets/image/customers/advert/' . $item->poster) }}" alt="">
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium">{{ $item->judul }}</p>
                                    <p class="text-[12px] text-gray-400"><i class="bi bi-alarm-fill"></i>
                                        {{ $item->durasi_hari }} Hari</p>
                                </div>
                            </div>
                            <div class="--body font-black text-[14px] whitespace-nowrap text-green-500">
                                Rp. {{ number_format($item->harga_iklan, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
