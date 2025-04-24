<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- todo import css --}}
    <link rel="stylesheet" href="{{ asset('css/scrollbar/scrollbar-sidebar.css') }}">
</head>

<body>
    <div class="min-h-screen flex flex-col small-desktop:hidden flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
        <div class="fixed flex flex-col top-0 left-0 w-64 bg-white h-full border-r">
            <div class="px-5 flex mt-[20px] items-center h-14">
                <div onclick="location.href='{{ route('home.index') }}'"
                    class="cursor-pointer text-[20px] font-black flex items-center gap-2">
                    <div><img class="w-[100px]" src="{{ asset('assets/logo/logo-kampsewa.png') }}" alt=""></div>
                    <div>KampSewa.</div>
                </div>
            </div>
            <div class="overflow-y-auto p-2 overflow-x-hidden flex-grow">
                <ul class="flex flex-col py-4 space-y-1">

                    {{-- todo MENU UTAMA --}}
                    <li class="px-5">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-medium tracking-wide text-[#8B97A8]">Utama</div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('home.index') }}"
                            class="relative flex flex-row rounded-[20px] items-center h-11 focus:outline-none hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white pr-6 {{ $title == 'Dashboard | Developer Kamp Sewa' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }}">
                            <span class="inline-flex mt-1 justify-center items-center ml-4">
                                <i
                                    class="{{ $title == 'Dashboard | Developer Kamp Sewa' ? 'text-white' : '' }} fi fi-rr-house-chimney-window"></i>
                            </span>
                            <span
                                class="ml-2 text-sm tracking-wide truncate {{ $title == 'Dashboard | Developer Kamp Sewa' ? 'text-white' : '' }}">Dashboard</span>
                        </a>
                    </li>
                    {{-- <a href="{{ route('notification.index') }}"
                        class="{{ $title == 'Dashboard | Notification' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} rounded-[20px] relative flex flex-row items-center h-11 focus:outline-none hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white border-transparent pr-6">
                        <span class="inline-flex justify-center mt-1 items-center ml-4">
                            <i class="fi fi-rr-bell {{ $title == 'Dashboard | Notification' ? 'text-white' : '' }}"></i>
                        </span>
                        <span
                            class="ml-2 {{ $title == 'Dashboard | Notification' ? 'text-white' : '' }} text-sm tracking-wide truncate">Notifications</span>
                    </a> --}}
                    </li>

                    {{-- todo MENU CUSTOMER --}}
                    <li class="px-5">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-medium tracking-wide text-[#8B97A8]">Customer</div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('kelola-pengguna.index') }}"
                            class="{{ $title == 'Detail Produk Sedang Disewa' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} {{ $title == 'Detail Produk Disewakan' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} {{ $title == 'Produk Disewakan' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} {{ $title == 'Kelola Pengguna | Developer Kamp Sewa' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} {{ $title == 'Detail Pengguna' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} rounded-[20px] relative flex flex-row items-center h-11 focus:outline-none hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white border-transparent pr-6">
                            <span
                                class="inline-flex {{ $title == 'Detail Produk Sedang Disewa' ? 'text-white' : '' }} {{ $title == 'Detail Produk Disewakan' ? 'text-white' : '' }} {{ $title == 'Produk Disewakan' ? 'text-white' : '' }} {{ $title == 'Kelola Pengguna | Developer Kamp Sewa' ? 'text-white' : '' }} {{ $title == 'Detail Pengguna' ? 'text-white' : '' }} mt-1 justify-center items-center ml-4">
                                <i class="fi fi-rr-user-gear"></i>
                            </span>
                            <span
                                class="ml-2 text-sm tracking-wide {{ $title == 'Detail Produk Sedang Disewa' ? 'text-white' : '' }} {{ $title == 'Detail Produk Disewakan' ? 'text-white' : '' }} {{ $title == 'Produk Disewakan' ? 'text-white' : '' }} truncate {{ $title == 'Kelola Pengguna | Developer Kamp Sewa' ? 'text-white' : '' }} {{ $title == 'Detail Pengguna' ? 'text-white' : '' }}">Kelola</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('informasi-pengguna.index') }}"
                            class="{{ $title == 'Informasi Pengguna' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} relative flex flex-row items-center h-11 rounded-[20px] focus:outline-none hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white border-transparent pr-6">
                            <span
                                class="{{ $title == 'Informasi Pengguna' ? 'text-white' : '' }} inline-flex mt-1 justify-center items-center ml-4">
                                <i class="fi fi-rr-file-user"></i>
                            </span>
                            <span
                                class="{{ $title == 'Informasi Pengguna' ? 'text-white' : '' }} ml-2 text-sm tracking-wide truncate">Informasi</span>
                        </a>
                    </li> --}}

                    {{-- todo MENU TRANSAKSI --}}
                    <li class="px-5">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-medium tracking-wide text-[#8B97A8]">Transaksi</div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('iklan.index') }}"
                            class="rounded-[20px] {{ $title == 'Iklan Customer' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} relative flex flex-row items-center h-11 hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white border-transparent pr-6">
                            <span
                                class="{{ $title == 'Iklan Customer' ? 'text-white' : '' }}' inline-flex mt-1 justify-center items-center ml-4">
                                <i class="{{ $title == 'Iklan Customer' ? 'text-white' : '' }} fi fi-rr-ad"></i>
                            </span>
                            <span
                                class="{{ $title == 'Iklan Customer' ? 'text-white' : '' }} ml-2 text-sm tracking-wide truncate">Iklan
                                Customer</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('penyewaan.index') }}"
                            class="{{ $title == 'Penyewaan' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} relative flex flex-row items-center h-11 hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white border-transparent rounded-full pr-6">
                            <span class="inline-flex mt-1 justify-center items-center ml-4">
                                <i class="{{ $title == 'Penyewaan' ? 'text-white' : '' }} fi fi-rr-boxes"></i>
                            </span>
                            <span
                                class="{{ $title == 'Penyewaan' ? 'text-white' : '' }} ml-2 text-sm tracking-wide truncate">Penyewaan</span>
                        </a>
                    </li> --}}

                    {{-- todo MENU KEUANGAN --}}
                    <li class="px-5">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-medium tracking-wide text-[#8B97A8]">Keuangan & Laporan</div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('penghasilan.index') }}"
                            class="{{ $title == 'Pengeluaran' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} {{ $title == 'Penghasilan' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] hover:text-white relative flex flex-row items-center h-11 focus:outline-none rounded-full text-gray-600 pr-6">
                            <span
                                class="{{ $title == 'Pengeluaran' ? 'text-white' : '' }} {{ $title == 'Penghasilan' ? 'text-white' : '' }} inline-flex mt-1 justify-center items-center ml-4">
                                <i
                                    class="{{ $title == 'Pengeluaran' ? 'text-white' : '' }} {{ $title == 'Penghasilan' ? 'text-white' : '' }} fi fi-rr-revenue-alt"></i>
                            </span>
                            <span
                                class="{{ $title == 'Pengeluaran' ? 'text-white' : '' }} {{ $title == 'Penghasilan' ? 'text-white' : '' }} ml-2 text-sm tracking-wide truncate">Penghasilan
                                & Pengeluaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rekap-keuangan.index') }}"
                            class="{{ $title == 'Rekap Keuangan | Developer' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] rounded-full relative flex flex-row items-center h-11 focus:outline-none text-gray-600 hover:text-white pr-6">
                            <span class="inline-flex mt-1 justify-center items-center ml-4">
                                <i
                                    class="{{ $title == 'Rekap Keuangan | Developer' ? 'text-white' : '' }} fi fi-rr-book"></i>
                            </span>
                            <span
                                class="{{ $title == 'Rekap Keuangan | Developer' ? 'text-white' : '' }} ml-2 text-sm tracking-wide truncate">Rekap
                                Keuangan</span>
                        </a>
                    </li>

                    {{-- todo MENU SETTINGS --}}
                    <li class="px-5">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-medium tracking-wide text-[#8B97A8]">Settings</div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('profile.index', ['nama_lengkap' => session('nama_lengkap')]) }}"
                            class="{{ $title == 'Profile | Developer Kamp Sewa' ? 'bg-gradient-to-bl from-[#B381F4] to-[#5038ED]' : '' }} rounded-full relative flex flex-row items-center h-11 focus:outline-none hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white pr-6">
                            <span
                                class="{{ $title == 'Profile | Developer Kamp Sewa' ? 'text-white' : '' }} inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </span>
                            <span
                                class="{{ $title == 'Profile | Developer Kamp Sewa' ? 'text-white' : '' }} ml-2 text-sm tracking-wide truncate">Profile</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="w-full" id="logoutForm">
                            @csrf
                            <button id="logoutButton"
                                class="relative w-full flex flex-row items-center h-11 focus:outline-none rounded-full hover:bg-gradient-to-bl hover:from-[#B381F4] hover:to-[#5038ED] text-gray-600 hover:text-white pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        const logoutButton = document.getElementById('logoutButton');
        logoutButton.addEventListener('click', (event) => {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to logout!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                } else {
                    // Handle ketika pengguna membatalkan tindakan logout
                    Swal.fire('Cancelled', 'Logout cancelled', 'info');
                }
            });
        });
    </script>
</body>

</html>
