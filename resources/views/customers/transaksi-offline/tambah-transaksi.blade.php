@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container w-full h-auto flex justify-center px-10 py-5 mobile-max:px-5 mobile-max:py-2">
        <div class="--wrapper-form w-[800px] h-auto bg-white shadow-box-shadow-11 p-4">
            <div class="mb-6"><a href="{{ route('transaksi-offline.order-offline') }}"><i class="bi bi-arrow-left-short"></i>
                    Kembali</a></div>
            <h1 class="text-[20px] font-bold">Transaksi Offline</h1>
            <p>Tambahkan transaksi penyewaan! anda bisa memasukkan data penyewa dan data barang dengan banyak ukuran dan
                jenis, seperti warna,
                kuantitas barang yang akan disewa.</p>
            <form id="#" action="#" class="w-full flex flex-col gap-6 h-auto mt-4" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_user" value="#">
                <div class="--input-table-produk grid gap-y-4">

                    <div class="grid grid-cols-2 gap-x-4 mobile-max:grid-cols-1">
                        <div class="--input-nama-produk w-full">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama Penyewa</p>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text" id="nama_penyewa" name="nama_penyewa" placeholder="Masukkan nama penyewa">
                        </div>

                        <div class="--input-no-telpon w-full">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nomer Telpon</p>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="number" id="no_telpon" name="no_telpon" placeholder="Masukkan no telpon penyewa">
                        </div>
                    </div>

                    <div class="--input-alamat w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Alamat</p>
                        <textarea
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat penyewa"></textarea>
                    </div>

                    {{-- <div class="--input-kategori relative w-full">
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
                    </div> --}}

                </div>

                <div class="grid grid-cols-2 gap-x-4 mobile-max:grid-cols-1">
                    <div class="--input-tanggal-mulai w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tanggal Mulai Sewa</p>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="date" id="tanggal_mulai" name="tanggal_mulai" required>
                    </div>

                    <div class="--input-tanggal-selesai w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tanggal Selesai Sewa
                        </p>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="date" id="tanggal_selesai" name="tanggal_selesai" required>
                    </div>
                </div>

                <div class="--input-table-variant-detail-variant" id="variantContainer">
                    <div class="variant">
                        <div class="w-1/2 mobile-max:w-full">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama Produk</p>
                            <select id="produk0" name="variants[0][produk]" required
                                class="tom-select block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">-- Pilih Produk --</option>
                                <option value="Tenda Dome 2P">Tenda Dome 2P</option>
                                <option value="Carrier 60L">Carrier 60L</option>
                                <option value="Sleeping Bag">Sleeping Bag</option>
                                <option value="Kompor Portable">Kompor Portable</option>
                            </select>
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
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Jumlah</p>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="number" id="jumlah" name="variants[0][sizes][0][jumlah]"
                                    placeholder="contoh: 20" required>
                            </div>
                            <div class="w-full">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Warna
                                </p>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="text" id="warna" name="variants[0][sizes][0][warna"
                                    placeholder="Contoh: Merah" required>
                            </div>
                            {{-- <div>
                                <p class="opacity-0">button</p>
                                <button type="button" class="py-3 px-4 rounded flex items-center justify-center h-full bg-red-100 text-red-500"
                                    onclick="removeSize(this)"><i class="bi bi-trash3-fill"></i></button>
                            </div> --}}
                        </div>
                        <div class="sizeContainer mt-2 mobile-max:w-full">
                            <button type="button"
                                class="mobile-max:w-full p-2 bg-blue-500 rounded mt-2 text-white font-medium text-[14px]"
                                onclick="addSize(this.parentElement)">Tambah Detail Variant</button>
                            {{-- <button type="button" class="p-2 bg-red-500 rounded mt-2 text-white font-medium text-[14px]" onclick="removeVariant(this)">Hapus Warna</button> --}}
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center gap-2">
                    <button type="button"
                        class="mobile-max:w-full p-2 bg-blue-500 rounded text-white font-medium text-[14px]"
                        onclick="addProduct()">Tambah Produk</button>
                    <button type="button"
                        class="mobile-max:w-full p-2 bg-green-500 rounded text-white font-medium text-[14px]" id=""
                        data-toggle="modal" data-target="#paymentModal">Lanjut Pembayaran</button>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="paymentForm" action="" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <!-- Total -->
                            <div class="form-group">
                                <label>Total yang harus dibayar</label>
                                <input type="text" class="form-control" id="total" name="total" value="50000"
                                    readonly>
                            </div>

                            <!-- Uang yang dibayarkan -->
                            <div class="form-group">
                                <label>Uang yang dibayarkan customer</label>
                                <input type="number" class="form-control" id="uang_dibayar" name="uang_dibayar"
                                    required>
                            </div>

                            <!-- Kembalian -->
                            <div class="form-group">
                                <label>Kembalian</label>
                                <input type="text" class="form-control" id="kembalian" readonly>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <select class="form-control" name="metode_pembayaran" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Proses Pembayaran</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function addProduct() {
            const variantContainer = document.getElementById('variantContainer');
            const variantCount = document.querySelectorAll('.variant').length;
            const newVariant = `
        <div class="variant">
            <div class="w-1/2 mt-4 mobile-max:w-full">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama Produk</p>
                <select id="produk0" name="variants[0][produk]" required
                                class="tom-select block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">-- Pilih Produk --</option>
                                <option value="Tenda Dome 2P">Tenda Dome 2P</option>
                                <option value="Carrier 60L">Carrier 60L</option>
                                <option value="Sleeping Bag">Sleeping Bag</option>
                                <option value="Kompor Portable">Kompor Portable</option>
                            </select>
            </div>
            <div class="sizeContainer mt-2 mobile-max:w-full">
                <button type="button" class="mobile-max:w-full p-2 bg-blue-500 rounded mt-2 text-white font-medium text-[14px]" onclick="addSize(this.parentElement)">Tambah Detail Variant</button>
                <button type="button" class="mobile-max:w-full p-2 bg-red-500 rounded mt-2 text-white font-medium text-[14px]" onclick="removeVariant(this)">Hapus Produk</button>
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
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Jumlah</p>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" name="variants[${variantIndex}][sizes][${sizeCount}][jumlah]" placeholder="contoh: 20" required>
            </div>
            <div class="w-full">
                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Warna</p>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" name="variants[${variantIndex}][sizes][${sizeCount}][warna]" placeholder="contoh: Merah" required>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        new TomSelect('#produk0', {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            placeholder: 'Cari dan pilih produk...'
        });
    </script>

    <script>
        document.getElementById('uang_dibayar').addEventListener('input', function() {
            const total = parseInt(document.getElementById('total').value);
            const dibayar = parseInt(this.value);
            const kembalian = dibayar - total;

            document.getElementById('kembalian').value = kembalian >= 0 ? kembalian : 0;
        });
    </script>
@endsection
