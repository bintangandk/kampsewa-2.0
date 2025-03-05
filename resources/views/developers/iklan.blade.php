@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container grid grid-cols-[2fr_1fr] gap-4 w-full p-8">
        <div class="_grid-1 flex flex-col gap-4 w-full">
            <div class="_three-card-information w-full grid grid-cols-3 gap-4">
                <div
                    class="_card-total-advert-transaction w-full rounded-[20px] cursor-pointer hover:shadow-box-shadow-7 grid items-center grid-cols-2 gap-2 p-2 bg-white">
                    <div class="_image"><img class="w-full object-cover scale-x-[-1]"
                            src="{{ asset('assets/vector/active-male-specialist-working-in-support-service.png') }}"
                            alt=""></div>
                    <div class="_section">
                        <div class="_header">
                            <h1 class="text-[14px] text-black">Total Transaksi</h1>
                        </div>
                        <div class="_body">
                            <p class="text-[28px] font-bold">{{ $get_count_total_transaksi_iklan }}</p>
                        </div>
                        <div class="_footer"></div>
                    </div>
                </div>
                <div
                    class="_card-total-waiting-inline-advert w-full rounded-[20px] cursor-pointer hover:shadow-box-shadow-7 grid items-center grid-cols-2 gap-2 p-2 bg-white">
                    <div class="_image"><img class="w-full object-cover"
                            src="{{ asset('assets/vector/active-time-management-using-clock-and-calendar.png') }}"
                            alt=""></div>
                    <div class="_section">
                        <div class="_header">
                            <h1 class="text-[14px] text-black">Total Antrian Iklan</h1>
                        </div>
                        <div class="_body">
                            <p class="text-[28px] font-bold">{{ $get_count_total_iklan_pending }}</p>
                        </div>
                        <div class="_footer"></div>
                    </div>
                </div>
                <div
                    class="_card-total-transaction-cancelled w-full rounded-[20px] cursor-pointer hover:shadow-box-shadow-7 grid items-center grid-cols-2 gap-2 p-2 bg-white">
                    <div class="_image"><img class="w-full object-cover scale-x-[-1]"
                            src="{{ asset('assets/vector/active-man-interacting-with-graphics-in-vr-glasses.png') }}"
                            alt=""></div>
                    <div class="_section">
                        <div class="_header">
                            <h1 class="text-[14px] text-black">Total Iklan Selesai</h1>
                        </div>
                        <div class="_body">
                            <p class="text-[28px] font-bold">{{ $get_count_total_iklan_selesai }}</p>
                        </div>
                        <div class="_footer"></div>
                    </div>
                </div>
            </div>
            <div id="scrollableDiv"
                class="_waiting-inline w-full h-[500px] px-4 pt-4 bg-white rounded-[20px] flex flex-col gap-4">
                <h1 class="text-[18px] font-medium">Antrian Menunggu Giliran</h1>
                <div class="_totaldata-searchfilter w-full flex items-center justify-between">
                    <div class="_total-data">
                        <p class="text-[14px] font-medium">{{ $get_count_total_iklan_pending }} Data</p>
                    </div>
                    <div class="_search-filter flex gap-2 items-center">
                        {{-- todo search --}}
                        <div class="_search">
                            <div class="_search">
                                <form class="form" method="GET">
                                    <label for="search">
                                        <input class="input" type="text" name="cari" value="{{ $cari }}"
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dataItems" class="_data-item w-full h-full flex flex-col gap-2 p-2 overflow-scroll">
                    @if ($user_pending->count() > 0)
                        @foreach ($user_pending as $user)
                            <div
                                class="_card p-2 rounded-[20px] hover:bg-[#F2F5FD] w-full grid grid-cols-5 items-center justify-between">
                                <div class="_nomor">
                                    <p
                                        class="flex items-center justify-center text-[12px] font-bold w-[30px] h-[30px] rounded-full p-2 bg-[#EFF2F7]">
                                        {{ $loop->iteration }}</p>
                                </div>
                                <div class="_image-name flex items-center gap-2">
                                    <img class="w-[40px] h-[40px] rounded-[10px] object-cover"
                                        src="{{ asset('assets/image/customers/profile/' . $user->foto) }}" alt="">
                                    <p class="text-[12px] font-medium">{{ $user->name }}</p>
                                </div>
                                <div class="_judul-iklan-status-iklan">
                                    <p
                                        class="text-[10px] font-bold w-fit rounded-full py-1 px-2 mt-1 bg-[#FEF2F2] text-[#F03E3E]">
                                        {{ $user->status_iklan }}</p>
                                </div>
                                <div class="_tanggalmulai whitespace-nowrap">
                                    <p class="text-[12px] font-medium p-2 bg-[#F0FDF4] text-[#34D399] rounded-full">
                                        {{ Carbon\Carbon::parse($user->tanggal_mulai)->format('d F Y') }}</p>
                                </div>
                                <div class="_action flex items-center gap-2">
                                    <form id="form_delete_iklan_pending"
                                        action="{{ route('iklan.delete-iklan-pending', ['id_iklan' => $user->id_iklan_main]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="_delete"><button id="delete_iklan_pending"
                                                class="w-[30px] h-[30px] rounded-full items-center justify-center flex bg-[#EFF2F7] cursor-pointer"><i
                                                    class="bi bi-trash-fill"></i></button></div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="w-full h-[300px] flex items-center justify-center">
                            <div class="flex items-center gap-4 justify-center">
                                <img class="w-[300px] h-auto object-cover"
                                    src="{{ asset('images/illustration/filling-survey.png') }}" alt="">
                                <div>
                                    <p class="text-[40px] font-black">OOPS!</p>
                                    <p class="text-[16px] font-medium">Sepertinya Tidak ada data</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{ $user_pending->onEachSide(1)->links('components.paginate.custom-pagination') }}
            <div class="_advert-history-transaction w-full h-[500px] px-4 pt-4 bg-white rounded-[20px] flex flex-col gap-4">
                <h1 class="text-[18px] font-medium">Riwayat Transaksi Iklan</h1>
                <div class="_totaldata-searchfilter w-full flex items-center justify-between">
                    <div class="_total-data">
                        <p class="text-[14px] font-medium">{{ $get_count_iklan_selesai }} Data</p>
                    </div>
                </div>
                <div id="dataItems" class="_data-item w-full h-full flex flex-col gap-2 p-2 overflow-scroll">
                    @if ($data_iklan_aktif->count() > 0)
                        @foreach ($data_iklan_selesai as $user)
                            <div
                                class="_card p-2 rounded-[20px] hover:bg-[#F2F5FD] w-full grid grid-cols-4 justify-between items-center">
                                <div class="_nomor">
                                    <p
                                        class="flex items-center justify-center text-[12px] font-bold w-[30px] h-[30px] rounded-full p-2 bg-[#EFF2F7]">
                                        {{ $loop->iteration }}</p>
                                </div>
                                <div class="_image-name flex items-center gap-2">
                                    <img class="w-[40px] h-[40px] rounded-[10px] object-cover"
                                        src="{{ asset('assets/image/customers/profile/' . $user->foto) }}"
                                        alt="">
                                    <p class="text-[12px] font-medium">{{ $user->name }}</p>
                                </div>
                                <div class="_judul-iklan-status-iklan">
                                    <p
                                        class="text-[10px] font-bold w-fit rounded-full py-1 px-2 text-[#34D399] bg-[#F0FDF4]">
                                        {{ $user->status_iklan }}</p>
                                </div>
                                <div class="_tanggalmulai">
                                    <p class="text-[12px] font-medium p-2  text-[#F03E3E] bg-[#FEF2F2]  rounded-full">
                                        {{ $user->tanggal_akhir }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="w-full h-[300px] flex items-center justify-center">
                            <div class="flex items-center gap-4 justify-center">
                                <img class="w-[300px] h-auto object-cover"
                                    src="{{ asset('images/illustration/filling-survey.png') }}" alt="">
                                <div>
                                    <p class="text-[40px] font-black">OOPS!</p>
                                    <p class="text-[16px] font-medium">Sepertinya Tidak ada data</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{ $data_iklan_selesai->onEachSide(1)->links('components.paginate.custom-pagination') }}
        </div>
        <div class="_grid-2 w-full">
            <div id="ongoing-advert" class="_ongoing-advert sticky top-4 w-full h-screen">
                <div class="_sub-wrapper flex flex-col gap-4 bg-white rounded-[20px] w-full h-full p-4">
                    <div class="_title">
                        <p class="text-[18px] font-medium">Iklan Sedang Aktif</p>
                        <p class="text-[14px]"><b>10</b> Iklan Sedang Aktif saat ini.</p>
                    </div>
                    <div class="_divider w-full h-[2px] bg-[#E5E7EB]"></div>
                    <div class="_card-wrapper w-full h-full overflow-scroll p-2 flex flex-col gap-6">
                        @foreach ($data_iklan_aktif as $user)
                            <div class="_card flex flex-col gap-2">
                                <a href="" class="group">
                                    <div class="_header relative w-full rounded-[20px] overflow-hidden">
                                        <div
                                            class="_hover-detail flex items-center justify-between w-full h-fit bottom-0 py-4 px-4 bg-gradient-to-t from-[#000000] to-[rgba(0, 0, 0, 0)] rounded-br-[10px] rounded-bl-[10px] absolute opacity-0 group-hover:opacity-100 transition duration-300">
                                            <p class="text-[14px] font-medium text-white">Lihat Detail</p>
                                            <p
                                                class="text-[18px] text-black w-[30px] h-[30px] rounded-full flex justify-center items-center bg-white">
                                                <i class="mt-1 fi fi-rr-angle-small-right"></i>
                                            </p>
                                        </div>
                                        <img class="w-full rounded-[20px] object-cover h-[200px]"
                                            src="{{ asset('assets/image/customers/advert/' . $user->poster) }}"
                                            alt="">
                                    </div>
                                    <div class="_body mt-2 flex flex-col gap-2">
                                        <div class="_judul-iklan">
                                            <p class="text-[16px] line-clamp-2 font-medium">{{ $user->judul }}</p>
                                        </div>
                                        <div class="_user-status-iklan flex items-center justify-between w-full">
                                            <div class="_user flex items-center gap-2">
                                                <img class="w-[40px] h-[40px] rounded-full object-cover"
                                                    src="{{ asset('assets/image/developers/agung-kurniawan.jpg') }}"
                                                    alt="">
                                                <div class="_name-address">
                                                    <p class="text-[14px] font-medium">{{ $user->name }}</p>
                                                    <p class="text-[12px] font-medium text-[#6B7280]">Surabaya</p>
                                                </div>
                                            </div>
                                            <div class="_status-iklan">
                                                <p
                                                    class="py-2 px-4 text-center text-[12px] font-bold text-white gradient-1 rounded-full">
                                                    {{ $user->status_iklan }}</p>
                                            </div>
                                        </div>
                                        @php
                                            $total_hari = Carbon\Carbon::parse($user->tanggal_akhir)->diffInDays($user->tanggal_mulai);
                                        @endphp
                                        <div class="_waktu-sewa">
                                            <span class="text-[12px] font-medium">Waktu Iklan Ditampilkan : </span>
                                            <span class="text-[12px] font-medium">{{ $total_hari }} Hari</span>
                                        </div>
                                        <div class="_start-finish w-full flex justify-between gap-2 items-center">
                                            <p
                                                class="text-[12px] font-bold p-2  text-[#F03E3E] bg-[#FEF2F2]  rounded-full">
                                                {{ Carbon\Carbon::parse($user->tanggal_mulai)->format('d F Y') }}</p>
                                            <p class="text-[12px] font-medium">sampai</p>
                                            <p
                                                class="text-[12px] font-bold p-2  text-[#34D399] bg-[#ECFDF5]  rounded-full">
                                                {{ Carbon\Carbon::parse($user->tanggal_akhir)->format('d F Y') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onscroll = function() {
            stickyFunction()
        };

        var ongoingAdvert = document.getElementById("ongoing-advert");
        var sticky = ongoingAdvert.offsetTop;

        function stickyFunction() {
            if (window.pageYOffset >= sticky) {
                ongoingAdvert.classList.add("py-4");
                ongoingAdvert.classList.remove("py-0");
            } else {
                ongoingAdvert.classList.remove("py-4");
                ongoingAdvert.classList.add("py-0");
            }
        }

        document.getElementById('delete_iklan_pending').addEventListener('click', (event) => {
            // Prevent default form submission
            event.preventDefault();

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda tidak akan dapat mengembalikan ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form_delete_iklan_pending').submit();
                }
            });
        });
    </script>

    @include('sweetalert::alert')
@endsection
