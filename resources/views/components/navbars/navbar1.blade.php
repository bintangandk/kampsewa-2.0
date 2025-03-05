<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <nav class="bg-white w-full">
        <div class="mx-auto max-w-7xl px-8 sm:px-6 lg:px-8">
            <div class="relative flex h-[100px] items-center justify-between">
                {{-- todo title --}}
                <div class="--title-icon-more flex items-center gap-4">
                    <div class="--more-icon-slide hidden small-desktop:block"><i class="text-[28px] font-bold bi bi-list"></i></div>
                    <div class="_title">
                        <p class="text-[16px] font-medium">Selamat Datang,</p>
                        <p class="text-[24px] font-bold">Developer!</p>
                    </div>
                </div>

                {{-- todo icon notification --}}
                <div class="relative ml-3 flex items-center gap-[50px] small-desktop:gap-4">
                    <div id="form-notification-as-read">
                        <div class="_icon" id="iconButton">
                            <div class="_notification relative w-[45px] h-[45px] gradient-1 cursor-pointer rounded-full flex items-center justify-center">
                                <i class="mt-2 text-white fi fi-rr-bell"></i>
                                <div id="count-nofication" class="{{ ($user_baru_terdaftar->count() > 0) ? '' : 'hidden' }} absolute top-0 right-0 mr-[-10px] font-bold w-[25px] h-[25px] text-[12px] bg-red-500 rounded-full text-white flex justify-center items-center">
                                 {{ $user_baru_terdaftar ? count($user_baru_terdaftar) : 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- todo profile --}}
                    <div class="_profile">
                        <a href="{{ route('profile.index', ['nama_lengkap' => session('nama_lengkap'), 'user_baru_daftar' => $user_baru_terdaftar]) }}"
                            class="flex items-center gap-[20px]">
                            <div class="_profile-name text-right">
                                <p class="text-[16px] font-bold">
                                    @if (session('nama_lengkap'))
                                        {{ session('nama_lengkap') }}
                                    @endif
                                </p>
                                <p class="text-[14px] text-[#8B97A8]">
                                    Developer
                                </p>
                            </div>
                            <div class="_profile-image-icon flex items-center gap-[10px]">
                                <img class="h-[50px] w-[50px] rounded-full"
                                    src="{{ asset('assets/image/developers/' . session('foto')) }}" alt="">
                            </div>
                        </a>
                    </div>

                    {{-- todo untuk dropdown notification --}}
                    <div id="dropdown-notification"
                        class="_wrapper-notification hidden z-10 absolute top-full w-[400px] h-[300px] overflow-y-auto bg-white shadow-box-shadow-12 rounded-[10px] right-0 overflow-hidden">
                        @if ($user_baru_terdaftar->count() == 0)
                            <div class="w-full h-full flex justify-center items-center">Tidak ada notifikasi</div>
                        @else
                            @foreach ($user_baru_terdaftar as $user)
                                <a href="{{ route('detail-pengguna.index', ['fullname' => $user->name]) }}" class="cursor-pointer flex hover:bg-gray-100 justify-between py-6 px-4 bg-white">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('assets/image/customers/profile/' . $user->foto) }}"
                                            class="rounded-full h-14 w-14" alt="">
                                        <div class="flex flex-col space-y-1">
                                            <span class="font-bold">{{ $user->name }}</span>
                                            <span class="text-sm">{{ $user->name }} telah melakukan registrasi
                                                aplikasi.</span>
                                        </div>
                                    </div>
                                    <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        <div class="_viewall p-[15px] flex justify-end">
                            <a href="{{ route('notification.index') }}" class="text-blue-700">{{ $user_baru_terdaftar->count() > 0 ? 'Lihat semua notifikasi' : '' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const iconButton = document.getElementById('iconButton');
        const item = document.getElementById('dropdown-notification');
        const count = document.getElementById('count-nofication');
        const form = document.getElementById('form-notification-as-read');

        iconButton.addEventListener('click', (e) => {
            e.preventDefault();
            item.classList.toggle('hidden');

            fetch(`/mark-notification-as-read`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menandai notifikasi sebagai terbaca');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                count.innerText = '0';
                count.style.display = 'none';
            })
            .catch(error => {
                console.error(error.message);
            });
        });
    </script>

</body>

</html>
