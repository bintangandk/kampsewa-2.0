@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container w-full h-auto p-8 flex justify-center">
        <div class="--input-design w-[700px] h-auto shadow-box-shadow-11 p-4 flex flex-col gap-6">
            <div class="--title-heading">
                <h1 class="text-[20px] font-bold">Input Data Untuk Kebutuhan Iklan</h1>
                <p class="text-[14px] mt-2">Input data ini digunakan untuk memberikan informasi kepada pengguna lain
                    bahwasanya produk iklan terkait
                    adalah milik anda.</p>
            </div>
            <form id="simpan-iklan"
                action="{{ route('layanan-iklan.simpan-iklan', ['id_user' => $id_user, 'harga_iklan' => $harga_sewa_iklan, 'durasi' => $durasi_sewa_iklan]) }}"
                method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf
                <div class="--table-iklan-table-detail-iklan">
                    <input type="hidden" name="id_user" value="{{ $id_user_dec }}">
                    <div class="--table-iklan flex flex-col gap-4">
                        <div class="--input-poster flex flex-col">
                            <p class="text-[14px] font-bold">Input Poster Anda!</p>
                            <p class="text-[12px] font-medium">Disarankan memiliki rasio ukuran 16:9</p>
                            <div>
                                <div>
                                    <img id="poster-preview" class="w-full max-h-[350px] object-cover"
                                        src="{{ asset('images/Ad 1012px - 506px.png') }}" alt="">
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input type="file" name="poster" value="{{ old('poster') }}" id="file-input" onchange="previewImage(event)"
                                        class="block w-full text-sm text-gray-500
                                  file:me-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-600 file:text-white
                                  hover:file:bg-blue-700
                                  file:disabled:opacity-50 file:disabled:pointer-events-none
                                  dark:text-neutral-500
                                  dark:file:bg-blue-500
                                  dark:hover:file:bg-blue-400
                                ">
                                </label>
                                @error('poster')
                                    <p class="text-red-500 text-xs mt-1">Poster Harus Di isi!</p>
                                @enderror
                            </div>
                        </div>
                        <div class="--input-judul">
                            <p class="text-[14px] font-bold">Judul Iklan</p>
                            <input type="text" value="{{ old('judul') }}" name="judul" id="input-judul"
                                placeholder="ex: Disarankan sesuai judul poster..."
                                class="w-full p-2 h-10 bg-gray-100 text-[14px]">
                            @error('judul')
                                <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}!</p>
                            @enderror
                        </div>
                        <div class="--input-sub-judul">
                            <p class="text-[14px] font-bold">Sub Judul Iklan</p>
                            <input type="text" value="{{ old('sub_judul') }}" name="sub_judul" id="input-sub-judul"
                                placeholder="ex: Jelaskan apa yang ingin anda tawarkan..."
                                class="w-full p-2 h-10 bg-gray-100 text-[14px]">
                            @error('sub_judul')
                                <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}!</p>
                            @enderror
                        </div>
                        <div class="--input-deskripsi">
                            <p class="text-[14px] font-bold">Deskripsi Iklan</p>
                            <textarea name="deskripsi" id="input-deskripsi" class="w-full p-2 h-10 bg-gray-100 text-[14px]"
                                placeholder="ex: Jelaskan detail iklan anda...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}!</p>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col gap-2">
                            <p class="text-[14px] font-bold">Harga Iklan Dipilih</p>
                            <div class="flex items-center gap-2">
                                <p>{{ number_format($harga_sewa_iklan, 0, ',', '.') }}</p>
                                <div class="w-[3px] h-[12px] bg-[#3C50E0] rounded-full"></div>
                                <p>{{ $durasi_sewa_iklan }} Hari</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="--button w-full flex items-center gap-2">
                    <button id="batalkan-input-iklan"
                        class="w-full p-2 border border-black text-black text-[14px]">Batalkan</button>
                    <button id="simpan-data-iklan"
                        class="w-full p-2 bg-gradient-to-bl from-[#B381F4] to-[#5038ED] text-white text-[14px]">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('poster-preview');
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }

        document.getElementById('simpan-data-iklan').addEventListener('click', (event) => {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah sudah yakin?',
                text: "Kamu akan save data iklan ini dan akan berlanjut ke tahap berikutnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('simpan-iklan').submit();
                } else {
                    Swal.fire('Cancelled', 'Save cancelled', 'info');
                }
            })
        });

        document.getElementById('batalkan-input-iklan').addEventListener('click', (event) => {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah sudah yakin?',
                text: "Kamu akan membatalkan input data iklan ini dan akan kembali halamana utama iklan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/customer/dashboard/buat-iklan/"
                } else {
                    Swal.fire('Cancelled', 'Cancel cancelled', 'info');
                }
            })
        });
    </script>
    {{-- @include('sweetalert::alert') --}}
@endsection
