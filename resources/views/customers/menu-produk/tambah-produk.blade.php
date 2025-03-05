@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container w-full h-auto flex justify-center px-10 py-5 mobile-max:px-5 mobile-max:py-2">
        <div class="--wrapper-form w-[800px] h-auto bg-white shadow-box-shadow-11 p-4">
            <div class="mb-6"><a href="{{ route('menu-produk.kelola-produk', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"><i class="bi bi-arrow-left-short"></i> Kembali</a></div>
            <h1 class="text-[20px] font-bold">Tambah Barang Penyewaan</h1>
            <p>Tambahkan barang penyewaan! anda bisa memasukkan data barang dengan banyak ukuran dan jenis, seperti warna,
                stok, dan harga sewa yang berbeda.</p>
            <form id="simpan-produk" action="{{ route('menu-produk.tambah-produk-post') }}"
                class="w-full flex flex-col gap-6 h-auto mt-4" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_user" value="{{ $id }}">
                <div class="--input-table-produk grid grid-cols-3 gap-x-2 gap-y-4 mobile-max:grid-cols-1">
                    <div class="--input-nama-produk w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama Produk</p>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="text" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk">
                    </div>
                    <div class="--input-deskripsi w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Deskripsi Produk</p>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="text" id="deskripsi_produk" name="deskripsi_produk"
                            placeholder="Masukkan deskripsi produk">
                    </div>
                    <div class="--input-kategori relative w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Kategori Produk</p>
                        <select name="kategori_produk"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                            <option value="Belum di isi">-- Pilih Kategori --</option>
                            <option value="Tenda">Tenda</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Tas">Tas</option>
                            <option value="Sepatu">Sepatu</option>
                            <option value="Perlengkapan">Perlengkapan</option>
                        </select>
                        <div class="pointer-events-none absolute top-1/2 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                        @error('kategori_produk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="--input-foto-depan flex flex-col">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Input Foto Depan</p>
                        <p class="text-[12px] font-medium mb-2">Disarankan memiliki rasio ukuran 1:1</p>
                        <div>
                            <div>
                                <img id="foto-depan" class="w-full h-[250px] object-cover"
                                    src="{{ asset('images/Upload.png') }}" alt="">
                            </div>
                            <label class="block">
                                <input id="foto_depan" type="file" name="foto_depan" value="{{ old('foto_depan') }}"
                                    onchange="previewImageFotoDepan(event)"
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
                            @error('foto_depan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="--input-foto-belakang flex flex-col">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Input Foto Belakang
                            <sup>Opsional</sup></p>
                        <p class="text-[12px] font-medium mb-2">Disarankan memiliki rasio ukuran 1:1</p>
                        <div>
                            <div>
                                <img id="foto-belakang" class="w-full h-[250px] object-cover"
                                    src="{{ asset('images/Upload.png') }}" alt="">
                            </div>
                            <label class="block">
                                <input id="foto_belakang" type="file" name="foto_belakang"
                                    value="{{ old('foto_belakang') }}" onchange="previewImageFotoBelakang(event)"
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
                            @error('foto_belakang')
                                <p class="text-red-500 text-xs mt-1">Foto Harus Di isi!</p>
                            @enderror
                        </div>
                    </div>
                    <div class="--input-foto-kiri flex flex-col">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Input Foto Kiri
                            <sup>Opsional</sup></p>
                        <p class="text-[12px] font-medium mb-2">Disarankan memiliki rasio ukuran 1:1</p>
                        <div>
                            <div>
                                <img id="foto-kiri" class="w-full h-[250px] object-cover"
                                    src="{{ asset('images/Upload.png') }}" alt="">
                            </div>
                            <label class="block">
                                <input id="foto_kiri" type="file" name="foto_kiri" value="{{ old('foto_kiri') }}"
                                    onchange="previewImageFotoKiri(event)"
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
                            @error('foto_kiri')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="--input-foto-kanan flex flex-col">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Input Foto Kanan
                            <sup>Opsional</sup></p>
                        <p class="text-[12px] font-medium mb-2">Disarankan memiliki rasio ukuran 1:1</p>
                        <div>
                            <div>
                                <img id="foto-kanan" class="w-full h-[250px] object-cover"
                                    src="{{ asset('images/Upload.png') }}" alt="">
                            </div>
                            <label class="block">
                                <input id="foto_kanan" type="file" name="foto_kanan" value="{{ old('foto_kanan') }}"
                                    onchange="previewImageFotoKanan(event)"
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
                            @error('foto_kanan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="--input-table-variant-detail-variant" id="variantContainer">
                    <div class="variant">
                        <div class="w-1/2 mobile-max:w-full">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Warna Produk</p>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text" id="warna0" name="variants[0][warna]" placeholder="contoh: Merah"
                                required>
                        </div>
                        <div class="size flex items-center gap-4 mt-2 mobile-max:flex-col">
                            <div class="w-full">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Ukuran</p>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="text" id="ukuran" name="variants[0][sizes][0][ukuran]"
                                    placeholder="contoh: 3x4/XXL" required>
                            </div>
                            <div class="w-full">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Stok</p>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="number" id="stok" name="variants[0][sizes][0][stok]"
                                    placeholder="contoh: 20" required>
                            </div>
                            <div class="w-full">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Harga Sewa
                                </p>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="number" id="harga_sewa" name="variants[0][sizes][0][harga_sewa]"
                                    placeholder="contoh: 10000" required>
                            </div>
                            {{-- <div>
                                <p class="opacity-0">button</p>
                                <button type="button" class="py-3 px-4 rounded flex items-center justify-center h-full bg-red-100 text-red-500"
                                    onclick="removeSize(this)"><i class="bi bi-trash3-fill"></i></button>
                            </div> --}}
                        </div>
                        <div class="sizeContainer mt-2 mobile-max:w-full">
                            <button type="button" class="mobile-max:w-full p-2 bg-blue-500 rounded mt-2 text-white font-medium text-[14px]"
                                onclick="addSize(this.parentElement)">Tambah Detail Variant</button>
                            {{-- <button type="button" class="p-2 bg-red-500 rounded mt-2 text-white font-medium text-[14px]" onclick="removeVariant(this)">Hapus Warna</button> --}}
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center gap-2">
                    <button type="button" class="mobile-max:w-full p-2 bg-blue-500 rounded text-white font-medium text-[14px]"
                        onclick="addVariant()">Tambah Warna</button>
                    <button class="mobile-max:w-full p-2 bg-green-500 rounded text-white font-medium text-[14px]"
                        id="simpan-data-produk">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addVariant() {
            const variantContainer = document.getElementById('variantContainer');
            const variantCount = document.querySelectorAll('.variant').length;
            const newVariant = `
        <div class="variant">
            <div class="w-1/2 mt-4 mobile-max:w-full">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Warna Produk</p>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" id="warna${variantCount}" name="variants[${variantCount}][warna]" placeholder="contoh: Merah" required>
            </div>
            <div class="sizeContainer mt-2 mobile-max:w-full">
                <button type="button" class="mobile-max:w-full p-2 bg-blue-500 rounded mt-2 text-white font-medium text-[14px]" onclick="addSize(this.parentElement)">Tambah Detail Variant</button>
                <button type="button" class="mobile-max:w-full p-2 bg-red-500 rounded mt-2 text-white font-medium text-[14px]" onclick="removeVariant(this)">Hapus Warna</button>
            </div>
        </div>
    `;
            variantContainer.insertAdjacentHTML('beforeend', newVariant);
        }

        function addSize(sizeContainer) {
            const variantIndex = Array.from(document.querySelectorAll('.variant')).indexOf(sizeContainer.parentElement);
            const sizeCount = sizeContainer.parentElement.querySelectorAll('.size').length + 1;
            const newSize = `
        <div class="size flex items-center gap-4 mt-2 mobile-max:flex-col">
            <div class="w-full">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Ukuran</p>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" name="variants[${variantIndex}][sizes][${sizeCount}][ukuran]" placeholder="contoh: 3x4/XXL" required>
            </div>
            <div class="w-full">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Stok</p>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" name="variants[${variantIndex}][sizes][${sizeCount}][stok]" placeholder="contoh: 20" required>
            </div>
            <div class="w-full">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Harga Sewa</p>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" name="variants[${variantIndex}][sizes][${sizeCount}][harga_sewa]" placeholder="contoh: 10000" required>
            </div>
            <div>
                <p class="opacity-0">button</p>
                <button type="button" class="py-3 px-4 rounded flex items-center justify-center h-full bg-red-100 text-red-500 mobile-max:w-fit"
                    onclick="removeSize(this)"><i class="bi bi-trash3-fill"></i></button>
            </div>
        </div>
    `;
            sizeContainer.insertAdjacentHTML('beforebegin', newSize);
            sizeContainer.querySelector('.size:last-child button').style.display = 'inline-block';
        }

        function removeVariant(button) {
            const variant = button.parentElement.parentElement;
            variant.remove();
        }

        function removeSize(button) {
            const size = button.parentElement.parentElement;
            size.remove();
        }


        function previewImageFotoDepan(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('foto-depan');
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }

        function previewImageFotoBelakang(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('foto-belakang');
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }

        function previewImageFotoKiri(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('foto-kiri');
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }

        function previewImageFotoKanan(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('foto-kanan');
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }

        document.getElementById('simpan-data-produk').addEventListener('click', (event) => {
            event.preventDefault();
            let namaProduk = document.getElementById('nama_produk').value;
            let deskripsiProduk = document.getElementById('deskripsi_produk').value;
            let kategoriProduk = document.getElementById('grid-state').value;
            let fotoDepan = document.getElementById('foto_depan').files[0];
            let warna = document.getElementById('warna0').value;
            let stok = document.getElementById('stok').value;
            let hargaSewa = document.getElementById('harga_sewa').value;

            if (!namaProduk) {
                Swal.fire({
                    title: 'Nama Produk Kosong',
                    text: 'Silakan isi nama produk sebelum menyimpan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (!deskripsiProduk) {
                Swal.fire({
                    title: 'Deskripsi Produk Kosong',
                    text: 'Silakan isi deskripsi sebelum menyimpan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (kategoriProduk === 'Belum di isi') {
                Swal.fire({
                    title: 'Belum Menentukan Kategori',
                    text: 'Silakan tentukan kategori produk sebelum menyimpan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (!fotoDepan) {
                Swal.fire({
                    title: 'Belum Mengisi Foto Depan',
                    text: 'Silakan isikan foto produk sebelum menyimpan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (!warna) {
                Swal.fire({
                    title: 'Belum Mengisi Warna Produk',
                    text: 'Silakan isikan warna produk sebelum menyimpan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (!ukuran) {
                Swal.fire({
                    title: 'Belum Mengisi Ukuran Produk',
                    text: 'Silakan isikan ukuran produk sebelum menyimpan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (!hargaSewa) {
                Swal.fire({
                    title: 'Belum Mengisi Harga Sewa Produk',
                    text: 'Silakan isikan harga sewa produk sebelum menyimpan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Apakah sudah yakin?',
                text: "Kamu akan save data ini dan bisa inputkan data produk lainnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('simpan-produk').submit();
                } else {
                    Swal.fire('Cancelled', 'Save cancelled', 'info');
                }
            });
        });


        function capitalizeFirstLetter(string) {
            return string.replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
        }

        var namaProdukInput = document.getElementById('nama_produk');
        namaProdukInput.addEventListener('input', function(event) {
            var inputValue = event.target.value;
            var capitalizedValue = capitalizeFirstLetter(inputValue);
            event.target.value = capitalizedValue;
        });

        document.getElementById('deskripsi_produk').addEventListener('input', function(event) {
            var inputValue = event.target.value;
            var capitalizedValue = inputValue.charAt(0).toUpperCase() + inputValue.slice(1);
            event.target.value = capitalizedValue;
        });
    </script>
@endsection
