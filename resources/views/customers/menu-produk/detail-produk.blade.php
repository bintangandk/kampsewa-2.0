@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container w-full p-4 sm:px-5 sm:py-8 md:px-5 md:py-10 lg:px-10 lg:py-10 xl:px-10 xl:py-10 flex flex-col gap-8">
        <div class="--wrapper-title">
            <h1 class="xl:text-[34px] text-[20px] sm:text-[24px] md:text-[28px] font-bold w-full text-center">Detail Produk</h1>
        </div>
        <div class="--wrapper-content w-full relative grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-4 md:grid-cols-2 md:gap-8 xl:gap-8">
            <div class="--wrapper-content-1 flex flex-col gap-4">
                <div class="--main-image justify-end w-full">
                    <img id="image-main" class="object-cover w-full"
                        src="{{ asset('assets/image/customers/produk/' . $detail_produk->foto_depan) }}" alt="">
                </div>
                <div class="--sub-image w-full grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="--image1 cursor-pointer">
                        <img class="hover:rounded-[20px] w-full h-full object-cover"
                            src="{{ asset('assets/image/customers/produk/' . $detail_produk->foto_depan) }}" alt=""
                            onclick="changeMainImage('{{ $detail_produk->foto_depan }}')">
                    </div>
                    <div class="--image2 cursor-pointer">
                        <img class="hover:rounded-[20px] w-full h-full object-cover"
                            src="{{ asset('assets/image/customers/produk/' . $detail_produk->foto_belakang) }}"
                            alt="" onclick="changeMainImage('{{ $detail_produk->foto_belakang }}')">
                    </div>
                    <div class="--image3 cursor-pointer">
                        <img class="hover:rounded-[20px] w-full h-full object-cover"
                            src="{{ asset('assets/image/customers/produk/' . $detail_produk->foto_kiri) }}" alt=""
                            onclick="changeMainImage('{{ $detail_produk->foto_kiri }}')">
                    </div>
                    <div class="--image4 cursor-pointer">
                        <img class="hover:rounded-[20px] w-full h-full object-cover"
                            src="{{ asset('assets/image/customers/produk/' . $detail_produk->foto_kanan) }}" alt=""
                            onclick="changeMainImage('{{ $detail_produk->foto_kanan }}')">
                    </div>
                </div>
            </div>
            <div class="--divider absolute opacity-0 sm:opacity-100 sm:left-1/2 bg-[#f4f4f4] rounded-full w-[3px] h-full"></div>
            <div class="--wrapper-content-2 w-full flex flex-col gap-8">
                <div class="--nama_produk text-[20px] sm:text-[20px] md:text-[20px] capitalize xl:text-[28px] font-bold">{{ $detail_produk->nama_produk }}</div>
                <div class="--deskripsi sm:font-medium text-[14px]">{{ $detail_produk->deskripsi_produk }}</div>
                <div class="--warna flex flex-col gap-4">
                    <div class="--list-color">
                 <div class="--heading mb-2">
                    <p class="xl:text-[20px] text-[16px] sm:text-[18px] font-medium">Warna</p>
                    <p class="text-[12px]">Klik warna untuk melihat detail variant!</p>
                 </div>
                        <div class="--list-warna flex flex-wrap gap-2">
                            @foreach ($variant_details as $warna => $details)
                                <div class="w-[30px] h-[30px] rounded-full cursor-pointer"
                                    onclick="showDetails('{{ $warna }}')" style="background-color: {{ $warna }}"></div>
                            @endforeach
                        </div>
                    </div>
                    <div id="variant-details">
                        <p class="xl:text-[20px] sm:text-[20px] font-medium mb-2">Details Variant</p>
                        @foreach ($variant_details as $warna => $details)
                            <div class="variant-detail" id="detail-{{ $warna }}" style="display: none;">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-2 px-4 border-b border-gray-300">Ukuran</th>
                                            <th class="py-2 px-4 border-b border-gray-300">Stok</th>
                                            <th class="py-2 px-4 border-b border-gray-300">Harga Sewa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="py-2 px-4 border-b border-gray-300">{{ $item->ukuran }}</td>
                                                <td class="py-2 px-4 border-b border-gray-300">{{ $item->stok }}</td>
                                                <td class="py-2 px-4 border-b border-gray-300">Rp.
                                                    {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="--wrapper-rating">
                    <p class="xl:text-[20px] text-[16px] sm:text-[20px] font-medium mb-2">Rating</p>
                    <div class="flex items-center gap-4">
                        <div class="--rating">
                            @php
                                $fullStars = floor($rating / 2); // Jumlah bintang penuh
                                $halfStar = $rating % 2; // Apakah ada setengah bintang?
                            @endphp

                            {{-- Bintang-bintang penuh --}}
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="text-[20px] bi bi-star-fill text-yellow-500"></i>
                            @endfor

                            {{-- Bintang setengah --}}
                            @if ($halfStar)
                                <i class="text-[20px] bi bi-star-half text-yellow-500"></i>
                            @endif

                            {{-- Bintang-bintang kosong --}}
                            @for ($i = 0; $i < 5 - $fullStars - $halfStar; $i++)
                                <i class="text-[20px] bi bi-star text-gray-400"></i>
                            @endfor
                        </div>
                        <div class="--total-ulasan text-[14px] font-medium group cursor-pointer">
                            <span class="group-hover:text-blue-500">{{ $total_ulasan }}</span>
                            <span><a href="#ulasan" class="underline group-hover:text-blue-500">Ulasan produk.</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="--ulasan w-full">
            <p class="sm:text-[20px] font-medium mb-4">Rating dan Ulasan Penyewa</p>
            <div class="--wrapper-card w-full grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="ulasan">
                @foreach ($userRatings as $ratingUlasan)
                    <div class="--card p-4 shadow-box-shadow-11">
                        <div class="--header flex items-start gap-4 mb-2">
                            <img class="w-[50px] h-[50px] rounded-full object-cover"
                                src="{{ asset('assets/image/customers/profile/'.$ratingUlasan->foto) }}" alt="">
                            <div class="--name-rating">
                                <p class="text-[14px] font-medium">{{ $ratingUlasan['user_name'] }}</p>
                                @php
                                    $fullStarsUlasan = floor($ratingUlasan['rating'] / 2); // Jumlah bintang penuh
                                    $halfStarUlasan = $ratingUlasan['rating'] % 2; // Apakah ada setengah bintang?
                                @endphp

                                {{-- Bintang-bintang penuh --}}
                                @for ($i = 0; $i < $fullStarsUlasan; $i++)
                                    <i class="bi bi-star-fill text-yellow-500"></i>
                                @endfor

                                {{-- Bintang setengah --}}
                                @if ($halfStarUlasan)
                                    <i class="bi bi-star-half text-yellow-500"></i>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="-body mt-2">
                            {{ $ratingUlasan['ulasan'] }}
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <script>
        function showDetails(warna) {
            // Sembunyikan semua detail varian
            document.querySelectorAll('.variant-detail').forEach(function(element) {
                element.style.display = 'none';
            });

            // Tampilkan detail varian yang dipilih
            document.getElementById('detail-' + warna).style.display = 'block';
        }
        // Tampilkan detail varian pertama saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            var firstVariant = document.querySelector('.variant-detail');
            if (firstVariant) {
                firstVariant.style.display = 'block';
            }
        });

        function changeMainImage(newSrc) {
            // Mengambil elemen gambar utama
            var mainImage = document.getElementById('image-main');

            // Mengganti sumber gambar utama dengan gambar yang diklik
            mainImage.src = "{{ asset('assets/image/customers/produk/') }}" + '/' + newSrc;
        }
    </script>
@endsection
