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
            <form action="{{ route('transaksi-offline.post') }}" method="POST" enctype="multipart/form-data"
                class="w-full flex flex-col gap-6 h-auto mt-4">
                @csrf
                <input type="hidden" name="id_user" value="{{ auth()->id() }}">

                {{-- Informasi Penyewa --}}
                <div class="grid gap-y-4">
                    <div>
                        <label class="block text-sm font-bold mb-2">Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" required class="w-full bg-gray-200 p-3 rounded" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" required class="w-full bg-gray-200 p-3 rounded"></textarea>
                    </div>
                </div>

                {{-- Tanggal --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-2">Tanggal Mulai Sewa</label>
                        <input type="date" name="tanggal_mulai" required class="w-full bg-gray-200 p-3 rounded" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Tanggal Selesai Sewa</label>
                        <input type="date" name="tanggal_selesai" required class="w-full bg-gray-200 p-3 rounded" />
                    </div>
                </div>

                {{-- Produk dan Variannya --}}
                <div id="variantContainer">
                    {{-- Variasi produk pertama --}}
                    <div class="variant border p-4 rounded mb-4" data-index="0">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block font-bold text-sm">Produk 1</label>
                            <button type="button" onclick="removeProduct(this)" class="text-red-600 text-sm">Hapus
                                Produk</button>
                        </div>
                        <select name="variants[0][produk]" required class="w-full bg-gray-200 p-3 mb-4 rounded">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produkList as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                            @endforeach
                        </select>

                        <div class="size-group space-y-3">
                            {{-- Ukuran pertama --}}
                            <div class="size-item grid md:grid-cols-5 gap-4 items-center">
                                <input type="text" name="variants[0][sizes][0][ukuran]" placeholder="Ukuran" required
                                    class="bg-gray-200 rounded px-4 py-3 w-full" />
                                <input type="number" name="variants[0][sizes][0][qty]" placeholder="Jumlah" required
                                    class="bg-gray-200 rounded px-4 py-3 w-full" />
                                <input type="text" name="variants[0][sizes][0][warna]" placeholder="Warna" required
                                    class="bg-gray-200 rounded px-4 py-3 w-full" />
                                <input type="number" name="variants[0][sizes][0][subtotal]" placeholder="Subtotal (Rp)"
                                    required class="bg-gray-200 rounded px-4 py-3 w-full" />
                                <button type="button" onclick="removeSize(this)"
                                    class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                            </div>
                        </div>

                        <button type="button" onclick="addSize(this)"
                            class="mt-3 bg-blue-600 text-white px-3 py-2 rounded text-sm">Tambah Ukuran</button>
                    </div>
                </div>

                {{-- Tombol Tambah Produk & Submit --}}
                <div class="flex flex-col sm:flex-row gap-2">
                    <button type="button" onclick="addProduct()"
                        class="bg-indigo-600 text-white px-4 py-2 rounded text-sm">Tambah Produk</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm">Lanjut
                        Pembayaran</button>
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


    {{-- <script>
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
                                @foreach ($produkList as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                                @endforeach
                            </select>
            </div>
             <div class="w-full">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Harga Sewa</p>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="number" id="subtotal" name="variants[0][sizes][0][sub_total]"
                                placeholder="contoh: 10000" required>
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
    </script> --}}
    <script>
        let variantIndex = 1;

        function addProduct() {
            const container = document.getElementById('variantContainer');
            const newVariant = document.createElement('div');
            newVariant.classList.add('variant', 'border', 'p-4', 'rounded', 'mb-4');
            newVariant.setAttribute('data-index', variantIndex);

            newVariant.innerHTML = `
            <div class="flex justify-between items-center mb-2">
                <label class="block font-bold text-sm">Produk ${variantIndex + 1}</label>
                <button type="button" onclick="removeProduct(this)" class="text-red-600 text-sm">Hapus Produk</button>
            </div>
            <select name="variants[${variantIndex}][produk]" required
                class="w-full bg-gray-200 p-3 mb-4 rounded">
                <option value="">-- Pilih Produk --</option>
                @foreach ($produkList as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                @endforeach
            </select>

            <div class="size-group space-y-3">
                <div class="size-item grid md:grid-cols-5 gap-4 items-center">
                    <input type="text" name="variants[${variantIndex}][sizes][0][ukuran]" placeholder="Ukuran"
                        required class="bg-gray-200 rounded px-4 py-3 w-full" />
                    <input type="number" name="variants[${variantIndex}][sizes][0][qty]" placeholder="Jumlah"
                        required class="bg-gray-200 rounded px-4 py-3 w-full" />
                    <input type="text" name="variants[${variantIndex}][sizes][0][warna]" placeholder="Warna"
                        required class="bg-gray-200 rounded px-4 py-3 w-full" />
                    <input type="number" name="variants[${variantIndex}][sizes][0][subtotal]" placeholder="Subtotal (Rp)"
                        required class="bg-gray-200 rounded px-4 py-3 w-full" />
                    <button type="button" onclick="removeSize(this)"
                        class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                </div>
            </div>

            <button type="button" onclick="addSize(this)"
                class="mt-3 bg-blue-600 text-white px-3 py-2 rounded text-sm">Tambah Ukuran</button>
        `;

            container.appendChild(newVariant);
            variantIndex++;
        }

        function removeProduct(button) {
            const variant = button.closest('.variant');
            variant.remove();
        }

        function addSize(button) {
            const variant = button.closest('.variant');
            const variantIdx = variant.getAttribute('data-index');
            const sizeGroup = variant.querySelector('.size-group');
            const sizeCount = sizeGroup.querySelectorAll('.size-item').length;

            const sizeHTML = `
            <div class="size-item grid md:grid-cols-5 gap-4 items-center">
                <input type="text" name="variants[${variantIdx}][sizes][${sizeCount}][ukuran]" placeholder="Ukuran"
                    required class="bg-gray-200 rounded px-4 py-3 w-full" />
                <input type="number" name="variants[${variantIdx}][sizes][${sizeCount}][qty]" placeholder="Jumlah"
                    required class="bg-gray-200 rounded px-4 py-3 w-full" />
                <input type="text" name="variants[${variantIdx}][sizes][${sizeCount}][warna]" placeholder="Warna"
                    required class="bg-gray-200 rounded px-4 py-3 w-full" />
                <input type="number" name="variants[${variantIdx}][sizes][${sizeCount}][subtotal]" placeholder="Subtotal (Rp)"
                    required class="bg-gray-200 rounded px-4 py-3 w-full" />
                <button type="button" onclick="removeSize(this)"
                    class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
            </div>
        `;

            sizeGroup.insertAdjacentHTML('beforeend', sizeHTML);
        }

        function removeSize(button) {
            const sizeItem = button.closest('.size-item');
            sizeItem.remove();
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
