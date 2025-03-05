@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container p-8 flex gap-8 flex-col">
        <div class="_header flex gap-4 items-center">
            <div class="_btn-back w-fit"><a href="{{ route('detail-pengguna.index', ['fullname' => $name]) }}"
                    class="flex items-center gap-2 px-4 py-2 gradient-1 text-white rounded-[10px]">
                    <p class="mt-1"><i class="text-[14px] fi fi-rr-arrow-small-left"></i></p>
                    <p class="text-[12px] font-medium">Kembali</p>
                </a></div>
            <div class="_title">
                <h1 class="text-[20px]">Detail Barang Yang Disewa oleh {{ $name }}</h1>
                <p class="text-[14px]">Menampilkan detail data dari barang yang disewa oleh user
                    <b>{{ $name }}</b>.
                </p>
            </div>
        </div>
        <div class="_container-content relative w-full grid grid-cols-2 gap-10">
            <div class="_component-image-produk relative w-full">
                <div class="_image-detail flex flex-col gap-2 sticky top-6 z-50">
                    <img class="rounded-[10px] w-full h-[450px] object-cover"
                        src="{{ asset('assets/image/customers/produk/gerber.png') }}" alt="">
                    <div class="_image-all grid grid-cols-4 gap-2 w-full">
                        <img class="rounded-[10px] object-cover w-full h-[120px]"
                            src="{{ asset('assets/image/customers/produk/shopping.webp') }}" alt="">
                        <img class="rounded-[10px] object-cover w-full h-[120px]"
                            src="{{ asset('assets/image/customers/produk/gerber.png') }}" alt="">
                        <img class="rounded-[10px] object-cover w-full h-[120px]"
                            src="{{ asset('assets/image/customers/produk/shopping.webp') }}" alt="">
                        <img class="rounded-[10px] object-cover w-full h-[120px]"
                            src="{{ asset('assets/image/customers/produk/gerber.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="_component-detail-data-produk flex flex-col gap-8">
                <div class="_detail">
                    <div class="_title text-[16px] font-bold mb-4">Detail Produk</div>
                    <div class="_field flex flex-col gap-1">
                        <div class="_nama-produk flex gap-2">
                            <p class="text-[14px] text-[#847588] text-nowrap">Nama Produk :</p>
                            <p class="text-[14px] font-medium">Gerber Multi-Purpose Nippers With Screw MultiFungsi Untuk
                                Kamping Berpengalaman Bagus</p>
                        </div>
                        <div class="_harga-sewa flex gap-2">
                            <p class="text-[14px] text-[#847588] text-nowrap">Harga Sewa :</p>
                            <p class="text-[14px] font-medium">Rp. 30.000,00 <sup>/Hari</sup></p>
                        </div>
                        <div class="_stok-produk flex gap-2">
                            <p class="text-[14px] text-[#847588] text-nowrap">Stok Produk :</p>
                            <p class="text-[14px] font-medium">38 Stok</p>
                        </div>
                        <div class="_status-produk flex gap-2">
                            <p class="text-[14px] text-[#847588] text-nowrap">Status Produk :</p>
                            <p class="text-[14px] font-medium">Tersedia</p>
                        </div>
                        <div class="_kategori-produk flex gap-2">
                            <p class="text-[14px] text-[#847588] text-nowrap">Kategori Produk :</p>
                            <p class="text-[14px] font-medium">Sleeping Bag</p>
                        </div>
                        <div class="_deskripsi-produk flex flex-col gap-2">
                            <p class="text-[14px] text-[#847588] text-nowrap">Deskripsi Produk :</p>
                            <p class="text-[14px] font-medium p-2 shadow-box-shadow-36 rounded-[10px]">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis quaerat repellendus odio
                                deleniti facilis, exercitationem temporibus soluta adipisci, neque odit rem quas, ut
                                excepturi autem praesentium. Fugit, odit maxime? Deserunt labore, recusandae porro officia
                                suscipit at dolorum error perferendis nulla, dolorem amet odit quidem doloribus temporibus
                                commodi? Non, expedita illum.
                            </p>
                        </div>
                        <div class="_tanggal-diposting flex gap-2">
                            <p class="text-[14px] text-[#847588] text-nowrap">Tanggal Diposting :</p>
                            <p class="text-[14px] font-medium">20 November 2024</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="_transaksi">
                    <div class="_title text-[16px] font-bold mb-4">Transaksi Produk</div>
                    <div class="_tanggal-transaksi-dilakukan flex gap-2">
                        <p class="text-[14px] text-[#847588] text-nowrap">Transaksi Dilakukan :</p>
                        <p class="text-[14px] font-medium">20 November 2024</p>
                    </div>
                    <div class="_tanggal-mulai flex gap-2">
                        <p class="text-[14px] text-[#847588] text-nowrap">Tanggal Mulai :</p>
                        <p class="text-[14px] font-medium">20 November 2024</p>
                    </div>
                    <div class="_tanggal-selesai flex gap-2">
                        <p class="text-[14px] text-[#847588] text-nowrap">Tanggal Selesai :</p>
                        <p class="text-[14px] font-medium">22 November 2024</p>
                    </div>
                    <div class="_total-harga-penyewaan flex gap-2">
                        <p class="text-[14px] text-[#847588] text-nowrap">Total Harga Penyewaan :</p>
                        <p class="text-[14px] font-medium">Rp. 140.000,00</p>
                    </div>
                    <div class="_status-pembayaran flex gap-2">
                        <p class="text-[14px] text-[#847588] text-nowrap">Status Pembayaran :</p>
                        <p class="text-[14px] font-bold">Lunas</p>
                    </div>
                    <div class="_status-penyewaan flex gap-2">
                        <p class="text-[14px] text-[#847588] text-nowrap">Status Penyewaan :</p>
                        <p class="text-[14px] font-bold">Sedang Disewa</p>
                    </div>
                    <div class="_jumlah-barang-disewa flex gap-2">
                        <p class="text-[14px] text-[#847588] text-nowrap">Jumlah Barang Disewa :</p>
                        <p class="text-[14px] font-medium">2 Barang</p>
                    </div>
                </div>
                <hr>
                <div class="_user-pemilik">
                    <div class="_title text-[16px] font-bold mb-4">Pemilik Barang Yang Disewa</div>
                    <div class="_user flex gap-2 items-center">
                        <div class="_img"><img class="rounded-full w-[40px] h-[40px]" src="{{ asset('assets/image/developers/agung-kurniawan.jpg') }}" alt=""></div>
                        <div class="_nama-visit">
                            <p><a href="" class="text-[14px] font-medium">Agung Kurniawan</a></p>
                            <p><a href="" class="hover:underline text-[14px] text-[#847588]">View Profile</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
