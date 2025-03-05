@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container flex flex-col gap-8 p-8">
        <div class="_component-card-statistik w-full grid grid-cols-4 gap-4">
            <div
                class="_total-pengguna-daftar-hari-ini flex flex-col justify-between w-full h-auto bg-white rounded-[20px] p-4">
                <div class="_header">
                    <p class="text-[18px] font-medium text-[#BAC3DC]">Total Pendaftar<br />Hari ini</p>
                </div>
                <div class="_body">
                    <p class="text-[28px] font-bold">{{ $user_pendaftar_hari_ini }} User</p>
                </div>
                <div class="_footer">
                    <p class="text-[14px]">Total User yang mendaftar hari {{ Carbon\Carbon::now()->subDay()->format('l') }}
                        kemarin adalah <b>{{ $user_pendaftar_kemarin }} User</b>.</p>
                </div>
            </div>
            <div
                class="_total-pengguna-daftar-minggu-ini flex flex-col justify-between w-full h-auto bg-white rounded-[20px] p-4">
                <div class="_header">
                    <p class="text-[18px] font-medium text-[#BAC3DC]">Total Pendaftar<br />Minggu ini</p>
                </div>
                <div class="_body">
                    <p class="text-[28px] font-bold">{{ $user_pendaftar_minggu_ini }} User</p>
                </div>
                <div class="_footer">
                    <p class="text-[14px]">Total User yang mendaftar minggu lalu adalah
                        <b>{{ $user_pendaftar_minggu_kemarin }} User</b>.
                    </p>
                </div>
            </div>
            <div
                class="_total-pengguna-daftar-bulan-ini flex flex-col justify-between w-full h-auti bg-white rounded-[20px] p-4">
                <div class="_header">
                    <p class="text-[18px] font-medium text-[#BAC3DC]">Total Pendaftar<br />Bulan ini</p>
                </div>
                <div class="_body">
                    <p class="text-[28px] font-bold">{{ $user_pendaftar_bulan_ini }} User</p>
                </div>
                <div class="_footer">
                    <p class="text-[14px]">Total User yang mendaftar bulan ini adalah <b>{{ $user_pendaftar_bulan_kemarin }}
                            User</b>.</p>
                </div>
            </div>
            <div
                class="_total-pengguna-daftar-tahun-ini flex flex-col justify-between w-full h-auto bg-white rounded-[20px] p-4">
                <div class="_header">
                    <p class="text-[18px] font-medium text-[#BAC3DC]">Total Pendaftar<br />Tahun ini</p>
                </div>
                <div class="_body">
                    <p class="text-[28px] font-bold">{{ $user_pendaftar_tahun_ini }} User</p>
                </div>
                <div class="_footer">
                    <p class="text-[14px]">Total User yang mendaftar tahun lalu adalah
                        <b>{{ $user_pendaftar_tahun_kemarin }} User</b>.
                    </p>
                </div>
            </div>
        </div>
        <div class="_data-pengguna w-full grid grid-cols-[2fr_1fr] gap-4">
            <form method="GET" class="w-full" id="form-filter">
                <div class="_component-list-data-filter w-full flex flex-col gap-4">
                    <div class="_component-filter-search flex gap-4 items-center">
                        <div class="_filter">
                            <div class="flex items-center justify-center">
                                <div class="relative inline-block text-left">
                                    <select id="filter" name="filter"
                                        class="origin-top-right z-10 mt-2 w-48 rounded-full px-4 py-2  text-[14px] mb-2 bg-white ring-1 ring-black ring-opacity-5">
                                        <option value="terlama" {{ request('filter') == 'terlama' ? 'selected' : '' }}>
                                            Terlama
                                        </option>
                                        <option value="terbaru" {{ request('filter') == 'terbaru' ? 'selected' : '' }}>
                                            Terbaru
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="_divider w-[2px] h-[28px] bg-white rounded-full"></div>
                        <div class="_search">
                            <div class="form">
                                <label for="search" class="bg-white  rounded-full">
                                    <input class="input" name="cari" type="text" value="{{ $cari_customer }}"
                                        placeholder="Cari kata" id="search">
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

                        <button type="submit" class="px-4 py-2 gradient-1 cursor-pointer text-white rounded-full">Lakukan
                            Aksi</button>
                    </div>

                    <div class="_component-category w-full flex gap-4 flex-wrap">
                        <div>
                            <label
                                class="cursor-pointer text-[14px] px-4 py-2 font-medium hover:bg-gradient-to-bl from-[#B381F4] to-[#5038ED] hover:text-white bg-white rounded-full flex items-center transition-colors duration-200">
                                <input type="checkbox" value="tidak_aktif_sebulan" name="tidak_aktif_sebulan"
                                    class="hidden opacity-0 absolute checkbox-input" />
                                <span class="relative z-10">Tidak Aktif 1 Bulan</span>
                            </label>
                        </div>
                        <div>
                            <label
                                class="cursor-pointer text-[14px] px-4 py-2 font-medium hover:bg-gradient-to-bl from-[#B381F4] to-[#5038ED] hover:text-white bg-white rounded-full flex items-center transition-colors duration-200">
                                <input type="checkbox" value="produk_terbanyak" name="produk_terbanyak"
                                    class="hidden opacity-0 absolute checkbox-input" />
                                <span class="relative z-10">Produk Terbanyak</span>
                            </label>
                        </div>
                    </div>

                    <div class="_component-list-data w-full bg-white rounded-[20px] pl-4 pr-4 pt-4">
                        <p class="text-[16px] font-medium">Total : {{ $count }} Users</p>
                        <div
                            class="_wrapper-card flex flex-col gap-2 {{ $users->count() > 0 ? 'min-h-[500px] max-h-[500px]' : 'h-auto' }} overflow-y-auto p-2">
                            @if ($users->count() > 0)
                                @foreach ($users as $item)
                                    <a href="{{ route('detail-pengguna.index', ['fullname' => $item->name]) }}">
                                        <div
                                            class="_card flex p-2 group rounded-[20px] cursor-pointer hover:bg-gradient-to-bl from-[#B381F4] to-[#5038ED] hover:text-white gap-4 justify-between items-center">
                                            <div class="_image-name-kota flex gap-2 items-center">
                                                <div class="_image">
                                                    <img class="object-cover w-[70px] h-[70px] rounded-[15px]"
                                                        src="{{ asset('assets/image/customers/profile/' . $item->foto) }}"
                                                        alt="">
                                                </div>
                                                <div class="_name-kota flex flex-col gap-1">
                                                    <div class="_name-kota">
                                                        <p class="text-[16px] font-medium">{{ $item->name }}</p>
                                                        <p class="text-[14px]">Kota Banyuwangi</p>
                                                    </div>
                                                    <p
                                                        class="text-[12px] group-hover:text-black font-medium w-fit px-2 py-1 rounded-full bg-[#EFF2F7]">
                                                        Customer</p>
                                                </div>
                                            </div>
                                            <div class="_icon-more">
                                                <p><i class="text-[20px] fi fi-rr-angle-small-right"></i></p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="w-full h-[300px] flex items-center justify-center">
                                    <div class="flex items-center gap-4 justify-center">
                                        <img class="w-[300px] h-auto object-cover"
                                            src="{{ asset('images/illustration/filling-survey.png') }}" alt="">
                                        <div>
                                            <p class="text-[40px] font-black">OOPS!</p>
                                            <p class="text-[16px] font-medium">Sepertiny Tidak ada data bernama
                                                <br>{{ $cari_customer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{ $users->onEachSide(1)->links('components.paginate.custom-pagination') }}
                </div>
            </form>
            <div class="_component-list-customer-sedang-aktif-sedang-sewa w-full h-full">
                <div class="_sub-container w-full grid grid-cols-1 gap-4 sticky top-4">
                    <div
                        class="_sedang-aktif bg-white w-full h-[250px] overflow-hidden max-h-[250px] pl-4 pr-4 pt-4 rounded-[20px]">
                        <h1 class="text-[14px] font-medium">Sedang Aktif</h1>
                        <p class="text-[12px]"><b>{{ $count_user_online }}</b> Users sedang beraktifitas</p>
                        <div class="_card-wrapper overflow-y-scroll max-h-[180px]">
                            @if ($get_customer_online->count() > 0)
                                @foreach ($get_customer_online as $item)
                                    <div
                                        class="_card flex p-2 group rounded-[20px] cursor-pointer hover:bg-gradient-to-bl from-[#B381F4] to-[#5038ED] hover:text-white gap-4 justify-between items-center">
                                        <div class="_image-name-kota flex gap-2 items-center">
                                            <div class="_image">
                                                <img class="object-cover w-[70px] h-[70px] rounded-[15px]"
                                                    src="{{ asset('assets/image/customers/profile/' . $item->foto) }}"
                                                    alt="">
                                            </div>
                                            <div class="_name-kota flex flex-col gap-1">
                                                <div class="_name-kota">
                                                    <p class="text-[16px] font-medium">{{ $item->name }}</p>
                                                    <p class="text-[14px]">Kota Banyuwangi</p>
                                                </div>
                                                <p
                                                    class="text-[12px] group-hover:text-black font-medium w-fit px-2 py-1 rounded-full bg-[#EFF2F7]">
                                                    Customer</p>
                                            </div>
                                        </div>
                                        <div class="_icon-more">
                                            <p><i class="text-[20px] fi fi-rr-angle-small-right"></i></p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="w-full h-[300px] flex items-center justify-center">
                                    <img class="w-[200px] h-auto object-cover"
                                        src="{{ asset('images/illustration/Monster 404 Error-rafiki.png') }}"
                                        alt="">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div
                        class="_sedang-sewa bg-white w-full h-[300px] overflow-hidden max-h-[300px] pl-4 pr-4 pt-4 rounded-[20px]">
                        <h1 class="text-[14px] font-medium">Sedang Sewa</h1>
                        <p class="text-[12px]"><b>164</b> Users sedang transaksi sewa.</p>
                        <div class="_card-wrapper overflow-y-scroll p-2 max-h-[250px]">
                            @for ($i = 0; $i < 10; $i++)
                                <div
                                    class="_card flex p-2 group rounded-[20px] cursor-pointer hover:bg-gradient-to-bl from-[#B381F4] to-[#5038ED] hover:text-white gap-4 justify-between items-center">
                                    <div class="_image-name-kota flex gap-2 items-center">
                                        <div class="_image">
                                            <img class="object-cover w-[70px] h-[70px] rounded-[15px]"
                                                src="{{ asset('assets/image/developers/agung-kurniawan.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="_name-kota flex flex-col gap-1">
                                            <div class="_name-kota">
                                                <p class="text-[16px] font-medium">Agung kurniawan</p>
                                                <p class="text-[14px]">Kota Banyuwangi</p>
                                            </div>
                                            <p
                                                class="text-[12px] group-hover:text-black font-medium w-fit px-2 py-1 rounded-full bg-[#EFF2F7]">
                                                Customer</p>
                                        </div>
                                    </div>
                                    <div class="_icon-more">
                                        <p><i class="text-[20px] fi fi-rr-angle-small-right"></i></p>
                                    </div>
                                </div>
                            @endfor
                            <div class="w-full h-[10px]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.checkbox-input');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        checkboxes.forEach(otherCheckbox => {
                            if (otherCheckbox !== this) {
                                otherCheckbox.checked = false;
                                otherCheckbox.parentNode.classList.remove('gradient-1');
                                otherCheckbox.parentNode.classList.add('bg-white');
                            }
                        });
                        this.parentNode.classList.add('gradient-1');
                        this.parentNode.classList.remove('bg-white');
                    } else {
                        this.parentNode.classList.remove('gradient-1');
                        this.parentNode.classList.add('bg-white');
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi untuk menambahkan kelas gradient-1 ke label
            function addGradientToLabel(checkboxName) {
                const label = document.querySelector(`input[name='${checkboxName}']`).closest('label');
                label.classList.add('gradient-1');
            }

            // Fungsi untuk menyimpan status checkbox ke penyimpanan
            function saveCheckboxStatus() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(function(checkbox) {
                    localStorage.setItem(checkbox.name, checkbox.checked);
                });
            }

            // Fungsi untuk memeriksa status checkbox dari penyimpanan dan menerapkan kelas jika diperlukan
            function checkCheckboxStatus() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(function(checkbox) {
                    const isChecked = localStorage.getItem(checkbox.name) === 'true';
                    if (isChecked) {
                        checkbox.checked = true;
                        addGradientToLabel(checkbox.name);
                    }
                });
            }

            // Panggil fungsi untuk memeriksa status checkbox saat halaman dimuat
            checkCheckboxStatus();

            // Tambahkan event listener untuk checkbox agar saat dicentang, status disimpan dan kelas diterapkan
            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    saveCheckboxStatus();
                    if (this.checked) {
                        addGradientToLabel(this.name);
                    }
                });
            });
        });
    </script>
@endsection
