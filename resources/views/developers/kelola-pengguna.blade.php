@extends('layouts.developers.ly-dashboard')
@section('content')
    {{-- todo modals tambah customer --}}
    @include('components.modals.add-customer')

    <div class="_container p-[20px] w-full">

        {{-- todo judul --}}
        <div class="_wrapper-judul mb-6">

            {{-- todo judul --}}
            <h1 class="text-[24px] font-bold text-[#19191B] capitalize">Data List Pengguna</h1>
        </div>

        {{-- todo wrapper total search filter --}}
        <div class="flex w-full justify-between items-center mb-4">

            {{-- todo total users --}}
            <div class="_total">
                <p class="text-[#19191b] text-[14px] font-bold">{{ $get_total_user }} Customer</p>
            </div>

            {{-- todo wrapper search filter --}}
            <form method="GET" class="_search-filter flex gap-[10px] items-center">
                {{-- todo search --}}
                <div class="_search">
                    <div class="form" method="GET">
                        <label for="search" class="bg-white  rounded-full">
                            <input class="input" type="text" placeholder="Cari kata" name="cari_customer" id="search"
                                autofocus="true" value="{{ $cari_customer }}">
                            <div class="fancy-bg"></div>
                            <div class="search">
                                <svg viewBox="0 0 24 24" aria-hidden="true"
                                    class="r-14j79pv r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-4wgw6l r-f727ji r-bnwqim r-1plcrui r-lrvibr">
                                    <g>
                                        <path
                                            d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- todo filter --}}
                <div class="_filter">
                    <div class="flex items-center justify-center">
                        <div class="relative inline-block text-left">
                            <select id="filter" name="filter"
                                class="origin-top-right z-10 mt-2 w-48 rounded-full px-4 py-2  text-[14px] mb-2 bg-white ring-1 ring-black ring-opacity-5">
                                <option value="terlama" {{ request('filter') == 'terlama' ? 'selected' : '' }}>Terlama
                                </option>
                                <option value="terbaru" {{ request('filter') == 'terbaru' ? 'selected' : '' }}>Terbaru
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- todo untuk tombol tambah data --}}
                <div class="_btn-tambah-data">
                    <button type="submit" class="px-4 py-2 gradient-1 cursor-pointer text-white rounded-full">
                        <div class="_icon-plus"></div>
                        <span>Cari</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- todo wrapper card --}}
        <div class="_wrapper-card flex mb-4 flex-col gap-3">
            {{-- todo card list --}}
            @foreach ($data as $item)
                <div
                    class="_card-pengguna gap-4 hover:shadow-box-shadow-7 grid grid-cols-4 w-full justify-between items-center bg-white rounded-[20px] p-[20px]">
                    <div class="_photo-name-address flex items-center gap-[10px]">
                        <div class="_photo relative overflow-hidden w-[60px] h-[60px] rounded-[20px]">
                            <img class="w-full object-cover"
                                src="{{ asset('assets/image/customers/profile/' . $item->foto) }}" alt="">
                        </div>
                        <div class="_name-address">
                            <div class="_name font-bold text-[#19191b] line-clamp-1">{{ $item->name }}</div>
                            <div class="_address text-gray-400 font-normal text-[12px] line-clamp-1">
                            Belum di isi.
                            </div>
                            <div class="_level w-fit mt-2">
                                <p class="bg-[#FDEAEE] text-[10px] font-bold rounded-full text-[#F5325C] text-center p-1">
                                    Customer</p>
                            </div>
                        </div>
                    </div>
                    <div class="_number-createdat">
                        <div class="_number flex flex-col">
                            <span class="text-[19191b] font-medium">Customer</span>
                            <span class="text-[12px] font-medium text-gray-400">{{ $item->nomor_telephone }}</span>
                        </div>
                        <div class="_createdat text-[12px] mt-2">
                            <span class="font-medium text-[#19191B]">Bergabung:</span>
                            <span
                                class="font-normal text-gray-400 border-dashed border-b-2">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="_total-product">
                        <p class="w-[80%] font-medium"><i class="mt-1 fi fi-rr-box-open"></i>
                            {{ $item->total_product ? $item->total_product . ' ' . 'Total produk disewakan' : 'Belum ada produk.' }}
                        </p>
                        <p class="text-[12px] text-gray-400 font-medium mt-1"><a
                                href=""><u>{{ $item->total_product ? 'Lihat semua produk' : '' }}</u></a></p>
                    </div>
                    <div class="_gender-iconmore flex justify-end w-full items-center gap-8">
                        <div
                            class="_gender flex p-3 rounded-r-full rounded-bl-full border-solid border-[2px] items-center gap-2">
                            <div class="_circle w-[12px] h-[12px] rounded-full bg-[#12A4ED]"></div>
                            <p class="text-[14px] font-medium text-[#19191b]">
                                {{ $item->jenis_kelamin ? $item->jenis_kelamin : 'Belum di isi.' }}</p>
                        </div>
                        <div class="_moreicon btn-more relative cursor-pointer">
                            <div class="relative"><i class="text-[20px] text-gray-400 fi fi-rr-rectangle-list"></i>
                            </div>
                            {{-- Dropdown menu --}}
                            <div class="dropdown-menu right-0 z-10 hidden absolute bg-white shadow-md rounded-md py-2 px-3">
                                {{-- Dropdown items --}}
                                <a href="{{ route('detail-pengguna.index', ['fullname' => $item->name]) }}"
                                    class="hover:text-[#12A4ED] dropdown-item flex gap-1 py-2">
                                    <span class="mt-[0.15rem]"><i class="fi fi-rr-folder-open"></i></span>
                                    <span>Detail</span>
                                </a>
                                <a href="#" class="hover:text-[#12A4ED] dropdown-item flex gap-1 py-2">
                                    <span class="mt-[0.15rem]"><i class="fi fi-rr-trash"></i></span>
                                    <span>Delete</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $data->onEachSide(1)->links('components.paginate.custom-pagination') }}
    </div>
    <script>
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
    <script>
        // Get all btn-more elements
        const btnsMore = document.querySelectorAll('.btn-more');

        // Iterate through each btn-more and add click event listener
        btnsMore.forEach(btnMore => {
            btnMore.addEventListener('click', function() {
                // Toggle the 'hidden' class of the dropdown-menu
                const dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.classList.toggle('hidden');
            });
        });

        // Close dropdown when clicking outside of it
        window.addEventListener('click', function(event) {
            btnsMore.forEach(btnMore => {
                if (!btnMore.contains(event.target)) {
                    const dropdownMenu = btnMore.querySelector('.dropdown-menu');
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
    <script>
        let modal = document.getElementById("modal");

        // Fungsi untuk menampilkan atau menyembunyikan modal
        function modalHandler(val) {
            if (val) {
                fadeIn(modal);
            } else {
                fadeOut(modal);
            }
        }

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }

        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }
    </script>
@endsection
