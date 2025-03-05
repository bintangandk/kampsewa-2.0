@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container w-full flex gap-4 flex-col p-8">
        <div class="_btn-back w-fit"><a href="{{ route('detail-pengguna.produk-disewakan', ['fullname' => $name]) }}"
                class="flex items-center gap-2 px-4 py-2 gradient-1 text-white rounded-[10px]">
                <p class="mt-1"><i class="text-[18px] fi fi-rr-arrow-small-left"></i></p>
                <p class="text-[14px] font-medium">Kembali</p>
            </a></div>
        <div class="_part-one w-full grid grid-cols-3 gap-8">
            <div class="_component-image-produk flex flex-col gap-2 w-full">
                <div class="_main-image"><img class="rounded-[10px] object-cover w-full h-full"
                        src="{{ asset('assets/image/customers/produk/gerber.png') }}" alt=""></div>
                <div class="_all-image w-full grid grid-cols-4 gap-2">
                    <img class="w-full object-cover h-[70px] rounded-[10px]"
                        src="{{ asset('assets/image/customers/produk/shopping.webp') }}" alt="">
                    <img class="w-full object-cover h-[70px] rounded-[10px]"
                        src="{{ asset('assets/image/customers/produk/shopping.webp') }}" alt="">
                    <img class="w-full object-cover h-[70px] rounded-[10px]"
                        src="{{ asset('assets/image/customers/produk/shopping.webp') }}" alt="">
                    <img class="w-full object-cover h-[70px] rounded-[10px]"
                        src="{{ asset('assets/image/customers/produk/shopping.webp') }}" alt="">
                </div>
            </div>
            <div class="_component-detail-produk">
                <div class="_nama-produk">
                    <h1 class="text-[18px] font-medium">ALLTREK Headlamp CAPTUN Hiking & Camping LED Portable - Black</h1>
                </div>
                <div class="_rating-totaldisewa mt-2 flex gap-2 items-center">
                    <div class="_totaldisewa font-medium text-[14px]">Total Disewa <font class="text-gray-400">57</font>
                    </div>
                    <div class="_node w-[5px] h-[5px] rounded-full bg-black/60"></div>
                    <div class="_rating flex gap-1 items-center">
                        <div class="mt-1"><i class="text-yellow-400 fi fi-rr-heart-rate"></i></div>
                        <div class="text-[14px] font-medium">4.5 <font class="text-gray-400">(218 rating)</font>
                        </div>
                    </div>
                </div>
                <div class="_harga-sewa mt-2">
                    <p class="text-[14px] font-medium text-gray-400">Harga Sewa:</p>
                    <p class="text-[28px] font-bold">Rp. 15.000 <sup class="text-[14px] font-medium">/Hari</sup></p>
                </div>
                <div class="_divider mt-4 w-full h-[1px] rounded-full bg-gray-300"></div>
                <div class="_stok-status-category mt-4">
                    <div class="_stok">
                        <font class="text-gray-400">Stok</font>: 20
                    </div>
                    <div class="_status-produk">
                        <font class="text-gray-400">Status</font>: Tersedia
                    </div>
                    <div class="_category-produk">
                        <font class="text-gray-400">Kategori</font>: Backpack
                    </div>
                </div>
                <div class="_divider mt-4 w-full h-[1px] rounded-full bg-gray-300"></div>
                <div class="_deskripsi mt-4">
                    <p class="text-[14px] font-medium text-gray-400">Deskripsi:</p>
                    <p class="text-[14px]">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe voluptatibus
                        recusandae, cupiditate dolores voluptate architecto. Dolore eveniet quam magni voluptate, at quod
                        recusandae error pariatur fugit distinctio explicabo repudiandae! In consectetur voluptate quasi,
                        voluptatem rem ratione iste aperiam deleniti est eum nisi autem molestias corrupti, amet architecto
                        doloremque! Temporibus dignissimos earum, voluptatum voluptatibus ex inventore. Eligendi soluta ipsa
                        quidem deserunt cum hic eos, alias quia sint amet magnam accusamus odit sunt nostrum reiciendis iure
                        similique et possimus fuga voluptatem corporis!</p>
                </div>
            </div>
            <div class="_component-produk-pernah-disewa-oleh">
                <div class="_design flex flex-col gap-4">
                    <div class="_title">
                        <p class="text-[18px] font-medium">Riwayat Sewa</p>
                        <p class="text-[14px]">Berikut daftar barang ini pernah disewa oleh beberapa customer.</p>
                    </div>
                    <div
                        class="_card-design shadow-box-shadow-36 rounded-[10px] w-full h-[400px] overflow-y-auto p-2 flex flex-col gap-2">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="_card-item">
                                <a href=""
                                    class="hover:bg-[#F2F5FD] p-2 rounded-[10px] flex justify-between w-full items-center">
                                    <div class="_img-name-duration flex items-center gap-1">
                                        <div class="_img"><img class="w-[40px] h-[40px] rounded-full object-cover"
                                                src="{{ asset('assets/image/developers/agung-kurniawan.jpg') }}"
                                                alt=""></div>
                                        <div class="_name-duration">
                                            <p class="text-[14px] font-medium">Agung Kurniawan</p>
                                            <div class="flex gap-1 items-center">
                                                <p class="mt-1"><i class="fi fi-rr-clock-three"></i></p>
                                                <p class="text-[12px]">3 Hari</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1"><i class="fi fi-rr-angle-small-right"></i></div>
                                </a>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
