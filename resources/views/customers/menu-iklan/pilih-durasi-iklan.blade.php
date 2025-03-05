@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container w-full h-auto px-10 py-5 flex flex-col gap-8">
        <h1 class="font-black text-[34px]">Pilih Durasi & Harga Iklan</h1>
        <div class="--wrapper-card grid grid-cols-3 gap-4 w-full">
            <a href="{{ route('layanan-iklan.index', ['id_user' => $id_user, 'harga_iklan' => 'paling-murah']) }}"
                class="hover:text-black hover:shadow-box-shadow-7">
                <div class="--card w-full h-full bg-[#CCFFF6] p-4 flex items-start justify-between">
                    <div class="flex flex-col h-full justify-between items-start gap-2">
                        <p class="text-[14px] font-medium"><i class="bi bi-currency-bitcoin"></i> Paling Murah</p>
                        <h1 class="text-[24px] font-medium">Durasi 1 Hari Iklan</h1>
                        <p class="text-[14px]">Layanan ini adalah layanan yang paling murah dan mungkin tidak
                            direkomendasikan. Tetapi perlu dicoba!</p>
                        <div class="mt-2 flex items-center gap-2 w-full">
                            <p class="text-[14px] font-medium bg-[#101010] text-white p-2">Rp. 50.000<sub>,00</sub></p>
                        </div>
                    </div>
                    <div class="h-full flex justify-center items-center">
                        <img class="w-[150px] min-w-[150px] object-cover"
                            src="{{ asset('images/illustration/Businessman-Giving-A-Keynote-2--Streamline-Manila.png') }}"
                            alt="">
                    </div>
                </div>
            </a>

            <a href="{{ route('layanan-iklan.index', ['id_user' => $id_user, 'harga_iklan' => 'murah']) }}"
                class="hover:text-black hover:shadow-box-shadow-7">
                <div class="--card w-full h-full bg-[#FFF7CC] p-4 flex items-start justify-between">
                    <div class="flex flex-col h-full justify-between items-start gap-2">
                        <p class="text-[14px] font-medium"><i class="bi bi-currency-bitcoin"></i> Murah</p>
                        <h1 class="text-[24px] font-medium">Durasi 2 Hari Iklan</h1>
                        <p class="text-[14px]">Layanan ini adalah layanan murah dengan durasi iklan lebih lama.</p>
                        <div class="mt-2 flex items-center gap-2 w-full">
                            <p class="text-[14px] font-medium bg-[#101010] text-white p-2">Rp. 90.000<sub>,00</sub></p>
                        </div>
                    </div>
                    <div class="h-full flex justify-center items-center">
                        <img class="w-[150px] min-w-[150px] object-cover"
                            src="{{ asset('images/illustration/Digital-Ads-1--Streamline-Manila.png') }}" alt="">
                    </div>
                </div>
            </a>

            <a href="{{ route('layanan-iklan.index', ['id_user' => $id_user, 'harga_iklan' => 'sedang']) }}"
                class="hover:text-black hover:shadow-box-shadow-7">
                <div class="--card w-full h-full bg-[#CCCDFF] p-4 flex items-start justify-between">
                    <div class="flex flex-col h-full justify-between items-start gap-2">
                        <p class="text-[14px] font-medium"><i class="bi bi-currency-bitcoin"></i> Sedang</p>
                        <h1 class="text-[24px] font-medium">Durasi 3 Hari Iklan</h1>
                        <p class="text-[14px]">Layanan ini menawarkan durasi iklan yang ideal untuk menarik perhatian
                            audiens.</p>
                        <div class="mt-2 flex items-center gap-2 w-full">
                            <p class="text-[14px] font-medium bg-[#101010] text-white p-2">Rp. 120.000<sub>,00</sub></p>
                        </div>
                    </div>
                    <div class="h-full flex justify-center items-center">
                        <img class="w-[150px] min-w-[150px] object-cover"
                            src="{{ asset('images/illustration/A-B-Testing--Streamline-Manila.png') }}" alt="">
                    </div>
                </div>
            </a>

            <a href="{{ route('layanan-iklan.index', ['id_user' => $id_user, 'harga_iklan' => 'ideal']) }}"
                class="hover:text-black hover:shadow-box-shadow-7">
                <div class="--card w-full h-full bg-[#FFFFFF] p-4 flex items-start justify-between">
                    <div class="flex flex-col h-full justify-between items-start gap-2">
                        <p class="text-[14px] font-medium"><i class="bi bi-currency-bitcoin"></i> Ideal</p>
                        <h1 class="text-[24px] font-medium">Durasi 5 Hari Iklan</h1>
                        <p class="text-[14px]">Layanan ini memberikan keseimbangan antara durasi dan biaya iklan.</p>
                        <div class="mt-2 flex items-center gap-2 w-full">
                            <p class="text-[14px] font-medium bg-[#101010] text-white p-2">Rp. 200.000<sub>,00</sub></p>
                        </div>
                    </div>
                    <div class="h-full flex justify-center items-center">
                        <img class="w-[150px] min-w-[150px] object-cover"
                            src="{{ asset('images/illustration/Bar-Graph--Streamline-Manila.png') }}" alt="">
                    </div>
                </div>
            </a>

            <a href="{{ route('layanan-iklan.index', ['id_user' => $id_user, 'harga_iklan' => 'populer']) }}"
                class="hover:text-black hover:shadow-box-shadow-7">
                <div class="--card w-full h-full bg-[#CCFFF6] p-4 flex items-start justify-between">
                    <div class="flex flex-col h-full justify-between items-start gap-2">
                        <p class="text-[14px] font-medium"><i class="bi bi-currency-bitcoin"></i> Populer</p>
                        <h1 class="text-[24px] font-medium">Durasi 7 Hari Iklan</h1>
                        <p class="text-[14px]">Layanan ini sangat populer untuk kampanye iklan jangka menengah.</p>
                        <div class="mt-2 flex items-center gap-2 w-full">
                            <p class="text-[14px] font-medium bg-[#101010] text-white p-2">Rp. 250.000<sub>,00</sub></p>
                        </div>
                    </div>
                    <div class="h-full flex justify-center items-center">
                        <img class="w-[150px] min-w-[150px] object-cover"
                            src="{{ asset('images/illustration/Competitor-Analysis--Streamline-Manila.png') }}"
                            alt="">
                    </div>
                </div>
            </a>

            <a href="{{ route('layanan-iklan.index', ['id_user' => $id_user, 'harga_iklan' => 'premium']) }}"
                class="hover:text-black hover:shadow-box-shadow-7">
                <div class="--card w-full h-full bg-[#FFF7CC] p-4 flex items-start justify-between">
                    <div class="flex flex-col h-full justify-between items-start gap-2">
                        <p class="text-[14px] font-medium"><i class="bi bi-currency-bitcoin"></i> Premium</p>
                        <h1 class="text-[24px] font-medium">Durasi 10 Hari Iklan</h1>
                        <p class="text-[14px]">Layanan ini menawarkan visibilitas tinggi dengan durasi iklan yang panjang.
                        </p>
                        <div class="mt-2 flex items-center gap-2 w-full">
                            <p class="text-[14px] font-medium bg-[#101010] text-white p-2">Rp. 300.000<sub>,00</sub></p>
                        </div>
                    </div>
                    <div class="h-full flex justify-center items-center">
                        <img class="w-[150px] min-w-[150px] object-cover"
                            src="{{ asset('images/illustration/Customize-Product--Streamline-Manila.png') }}"
                            alt="">
                    </div>
                </div>
            </a>

            <a href="{{ route('layanan-iklan.index', ['id_user' => $id_user, 'harga_iklan' => 'ultimate']) }}"
                class="hover:text-black hover:shadow-box-shadow-7">
                <div class="--card w-full h-full bg-[#CCCDFF] p-4 flex items-start justify-between">
                    <div class="flex flex-col h-full justify-between items-start gap-2">
                        <p class="text-[14px] font-medium"><i class="bi bi-currency-bitcoin"></i> Ultimate</p>
                        <h1 class="text-[24px] font-medium">Durasi 14 Hari Iklan</h1>
                        <p class="text-[14px]">Layanan ini sangat cocok untuk kampanye iklan jangka panjang dengan hasil
                            maksimal.</p>
                        <div class="mt-2 flex items-center gap-2 w-full">
                            <p class="text-[14px] font-medium bg-[#101010] text-white p-2">Rp. 400.000<sub>,00</sub></p>
                        </div>
                    </div>
                    <div class="h-full flex justify-center items-center">
                        <img class="w-[150px] min-w-[150px] object-cover"
                            src="{{ asset('images/illustration/Online-Exams-Tests-1--Streamline-Manila.png') }}"
                            alt="">
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
