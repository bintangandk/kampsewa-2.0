{{-- ambil turunan design --}}
@extends('customers.menu-dashboard-cust.dashboard')
{{-- gunakan section dengan nama yang sesuai untuk custom content --}}
@section('customer-content')
    {{-- container utama pembungkus kontent utama --}}
    <div class="--container small-desktop:px-7 small-desktop:py-2 px-10 py-5 flex flex-col gap-8">
        {{-- heading dan deskripsi halaman --}}
        <div class="--wrapper-heading-wrapper-deskripsi-halaman">
            <h1 class="text-[24px] font-bold capitalize">Manajemen Produk Anda!</h1>
            <p class="text-[14px]">Halaman ini berisi data produk anda, anda bisa menambah, mengedit dan menghapus produk,
                melihat produk yang
                sedang disewa, menampilkan berdasarkan produk terlaris disewa, harga sewa termurah - termahal, produk
                terbaru
                dan terlama sekaligus bisa mencari berdasarkan kosakata nama produk dan harga. Jika anda masih bingung lihat
                menu cara penggunaan fitur pada menu <a href=""
                    class="text-blue-700 underline hover:underline font-bold">Dokumentasi</a>.</p>
        </div>

        {{-- wrapper navigation item menu --}}
        <div class="--wrapper-navigation-menu w-full">
            <ul class="flex items-center gap-x-4 gap-y-4 flex-wrap">
                <li><a class="{{ $title == 'Produk Menu | KampSewa' ? 'bg-[#F8F7F4] font-medium' : '' }} hover:font-medium hover:bg-[#F8F7F4] hover:text-[#0F172A] text-[14px] px-4 py-2 rounded-full"
                        href="{{ route('menu-produk.index', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Semua
                        Produk</a></li>
                <li><a class="text-[14px] hover:font-medium px-4 py-2 rounded-full hover:bg-[#F8F7F4] hover:text-[#0F172A]"
                        href="{{ route('menu-produk.kelola-produk', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Kelola
                        Produk</a></li>
                <li><a class="text-[14px] hover:font-medium px-4 py-2 rounded-full hover:bg-[#F8F7F4] hover:text-[#0F172A]"
                        href="{{ route('menu-produk.sedang-disewa', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Sedang
                        Disewa</a></li>
            </ul>
        </div>

        <hr>

        {{-- pembungkus kontent filter dan list produk --}}
        <div class="--wrapper-filter-wrapper-list-product mobile-max:flex-col mobile-max:gap-10 w-full flex gap-4 items-start h-auto">
            {{-- filter --}}
            <div class="--wrapper-filter max-w-[500px] mobile-max:w-full mobile-max:relative sticky top-4">
                <form id="formSide" method="GET" class="flex w-full flex-col gap-4">
                    <div class="--search w-full flex flex-col gap-2">
                        <p class="text-[14px] font-medium">Pencarian Produk:</p>
                        <div class="relative w-full mx-auto">
                            <input name="search" value="{{ $search }}"
                                class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="search" placeholder="Search">
                        </div>
                    </div>

                    {{-- filter category --}}
                    <div class="--search flex flex-col gap-2">
                        <p class="text-[14px] font-medium">Pilih Category:</p>
                        <div class="custom-select-wrapper">
                            <select id="countries" name="filter_side" class="custom-select">
                                <option value="" {{ empty($filter_side) ? 'selected' : '' }}>Semua</option>
                                <option value="tenda" {{ $filter_side == 'tenda' ? 'selected' : '' }}>Tenda</option>
                                <option value="tas" {{ $filter_side == 'tas' ? 'selected' : '' }}>Tas</option>
                                <option value="sepatu" {{ $filter_side == 'sepatu' ? 'selected' : '' }}>Sepatu</option>
                                <option value="perlengkapan" {{ $filter_side == 'perlengkapan' ? 'selected' : '' }}>
                                    Perlengkapan</option>
                            </select>
                        </div>
                    </div>

                    <div class="--wrapper-button w-full">
                        <button id="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-full">Lakukan
                            Aksi</button>
                    </div>
                </form>
            </div>

            {{-- divider --}}
            <div class="w-[3px] h-screen bg-[#19191b] sticky top-4 mobile-max:hidden"></div>

            {{-- list produk --}}
            <div class="--wrapper-produk w-full flex flex-col gap-4">
                <div class="w-full flex items-center justify-between">
                    <p class="text-[14px]">{{ $result }} Hasil Produk</p>
                    <form id="filterFormRight" method="GET">
                        <select name="filter_right" id="filterRight" class="focus:outline-none text-[14px]">
                            <option value="terbaru" {{ $filter_right == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ $filter_right == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="termahal" {{ $filter_right == 'termahal' ? 'selected' : '' }}>Harga Termahal
                            </option>
                            <option value="termurah" {{ $filter_right == 'termurah' ? 'selected' : '' }}>Harga Termurah
                            </option>
                        </select>
                    </form>
                </div>
                <div class="--wrapper-card w-full">
                    @if ($produk->count() == 0)
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="flex items-center gap-4 justify-center">
                                <img class="w-[300px] mobile-max:w-full h-auto object-cover"
                                    src="{{ asset('images/illustration/filling-survey.png') }}" alt="">
                                <div>
                                    <p class="text-[40px] font-black">OOPS!</p>
                                    <p class="text-[16px] font-medium">Sepertinya {{ $search }} Tidak ada dalam
                                        daftar
                                        produk!
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="--card-design grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4">
                            @foreach ($produk as $item)
                                <a href="{{ route('menu-produk.detail-produk', ['id_produk' => Crypt::encrypt($item->id_produk)]) }}" class="hover:text-black group">
                                    <div class="--card-item flex flex-col gap-2">
                                        <div class="--header">
                                            <img class="w-[250px] mobile-max:w-full mobile-max:h-full h-[250px] medium-screen:w-[200px] medium-screen:h-[200px] object-cover rounded-[30px]"
                                                src="{{ asset('assets/image/customers/produk/' . $item->foto_depan) }}"
                                                alt="">
                                        </div>
                                        <div class="--body">
                                            <p
                                                class="capitalize text-[18px] font-medium line-clamp-1 group-hover:underline">
                                                {{ $item->nama_produk }}</p>
                                            <p class="text-[14px] text-gray-400"><i class="bi bi-box-fill"></i> Stok :
                                                {{ $item->stok_produk }}</p>
                                            <div class="flex items-center gap-2 mt-2">
                                                <p
                                                    class="text-[12px] font-medium bg-[#F6F7FF] text-[#8DBCFF] px-2 py-1 rounded-[5px]">
                                                    {{ $item->kategori_produk }}</p>
                                                <p
                                                    class="text-[12px] font-medium bg-[#FEF2EC] text-[#EF9866] px-2 py-1 rounded-[5px]">
                                                    {{ number_format($item->harga_sewa_min, 0, ',', '.') }}/Hari</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                {{ $produk->onEachSide(1)->links('components.paginate.custom-pagination') }}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // Simpan nilai search dan filter_side saat halaman dimuat
            var searchValue = "{{ $search }}";
            var filterSideValue = "{{ $filter_side }}";

            // Tombol submit pada formSide
            document.getElementById('submit').addEventListener('click', function(event){
                event.preventDefault();
                var formSide = document.getElementById('formSide');
                var filterRightValue = document.getElementById('filterRight').value;

                // Menambahkan parameter filter_right ke URL
                var urlParams = new URLSearchParams(window.location.search);
                urlParams.set('filter_right', filterRightValue);

                // Menyiapkan URL dengan parameter tambahan
                var url = '?' + urlParams.toString();

                // Menggabungkan parameter dari formSide ke URL
                var formData = new FormData(formSide);
                formData.forEach((value, key) => {
                    urlParams.set(key, value);
                });

                // Mengirimkan permintaan ke URL yang diperbarui
                window.location.href = url + '&' + urlParams.toString();
            });

            // Menangani perubahan pada elemen select di filterFormRight
            document.getElementById('filterRight').addEventListener('change', function() {
                var filterFormRight = document.getElementById('filterFormRight');
                var filterRightValue = filterFormRight.elements['filter_right'].value;

                // Menyiapkan URL dengan parameter filter_right
                var url = '?filter_right=' + filterRightValue;

                // Menambahkan nilai search dan filter_side ke URL
                url += '&search=' + searchValue;
                url += '&filter_side=' + filterSideValue;

                // Mengirimkan permintaan ke URL yang diperbarui
                window.location.href = url;
            });
        });
    </script>
@endsection
