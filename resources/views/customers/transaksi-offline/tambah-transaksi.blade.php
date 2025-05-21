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
                <input type="hidden" name="id_user" value="{{ auth()->id() }}">

                <div class="--input-table-produk grid gap-y-4">
                    <div class="--input-nama-produk w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama Penyewa</p>
                        <input type="text" id="nama_penyewa" name="nama_penyewa" placeholder="Masukkan nama penyewa"
                            required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="--input-alamat w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Alamat</p>
                        <textarea id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat penyewa" required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-4 mobile-max:grid-cols-1">
                    <div class="--input-tanggal-mulai w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tanggal Mulai Sewa</p>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="--input-tanggal-selesai w-full">
                        <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tanggal Selesai Sewa
                        </p>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                </div>

                {{-- Container Produk dan Variannya --}}
                <div class="--input-table-variant-detail-variant" id="variantContainer">
                    <div class="variant" data-index="0">
                        <div class="w-full">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama Produk</p>
                            <select name="variants[0][produk]" required
                                class="tom-select block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($produkList as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full mt-4">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Harga Sewa</p>
                            <input type="number" name="variants[0][sizes][0][subtotal]" placeholder="Contoh: 10000"
                                required
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>

                        <div class="size flex items-center gap-4 mt-2 mobile-max:flex-col">
                            <div class="w-full">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Ukuran</p>
                                <input type="text" name="variants[0][sizes][0][ukuran]" placeholder="Contoh: 3x4/XXL"
                                    required
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            </div>

                            <div class="w-full">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Jumlah</p>
                                <input type="number" name="variants[0][sizes][0][qty]" placeholder="Contoh: 2" required
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            </div>

                            <div class="w-full">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Warna</p>
                                <input type="text" name="variants[0][sizes][0][warna]" placeholder="Contoh: Merah"
                                    required
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="w-full flex items-center gap-2">
                    <button type="button"
                        class="mobile-max:w-full p-2 bg-blue-500 rounded text-white font-medium text-[14px]"
                        onclick="addProduct()">Tambah Produk</button>
                    <button type="submit"
                        class="mobile-max:w-full p-2 bg-green-500 rounded text-white font-medium text-[14px]">Lanjut
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
        let variantIndex = 0;

        function addProduct() {
            const container = document.getElementById('variantContainer');

            const variantHTML = `
            <div class="variant border p-4 mt-4 rounded bg-gray-100 relative">
                <div class="w-full mt-2">
                    <label class="block text-sm font-bold mb-1">Nama Produk</label>
                    <select name="variants[${variantIndex}][produk]" required
                        class="tom-select block w-full bg-white border border-gray-300 rounded px-3 py-2">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produkList as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full mt-2">
                    <label class="block text-sm font-bold mb-1">Sub Total (Harga Sewa)</label>
                    <input type="number" name="variants[${variantIndex}][subtotal]" required
                        placeholder="contoh: 10000"
                        class="block w-full bg-white border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="sizeContainer mt-2">
                    <!-- Ukuran pertama ditambahkan via JS -->
                </div>

                <button type="button" class="mt-3 bg-blue-500 text-white px-3 py-2 rounded" onclick="addSize(this)">Tambah Ukuran</button>
                <button type="button" class="mt-2 bg-red-500 text-white px-3 py-2 rounded" onclick="removeVariant(this)">Hapus Produk</button>
            </div>
        `;

            container.insertAdjacentHTML('beforeend', variantHTML);

            // Tambah ukuran pertama otomatis
            const newVariant = container.querySelectorAll('.variant')[variantIndex];
            const sizeContainer = newVariant.querySelector('.sizeContainer');
            addSize(sizeContainer);

            variantIndex++;
        }

        function addSize(buttonOrContainer) {
            // Cek apakah parameter adalah tombol atau langsung container
            const variantDiv = buttonOrContainer.closest('.variant');
            const sizeContainer = variantDiv.querySelector('.sizeContainer');

            const currentVariantIndex = Array.from(document.querySelectorAll('.variant')).indexOf(variantDiv);
            const sizeIndex = sizeContainer.querySelectorAll('.size').length;

            const sizeHTML = `
            <div class="size flex flex-wrap gap-2 bg-white p-3 rounded border mt-2">
                <div class="w-full sm:w-1/3">
                    <label class="block text-sm font-bold mb-1">Ukuran</label>
                    <input type="text" name="variants[${currentVariantIndex}][sizes][${sizeIndex}][ukuran]" required
                        placeholder="contoh: M/XXL"
                        class="block w-full bg-white border border-gray-300 rounded px-3 py-2">
                </div>
                <div class="w-full sm:w-1/3">
                    <label class="block text-sm font-bold mb-1">Jumlah</label>
                    <input type="number" name="variants[${currentVariantIndex}][sizes][${sizeIndex}][jumlah]" required
                        placeholder="contoh: 10"
                        class="block w-full bg-white border border-gray-300 rounded px-3 py-2">
                </div>
                <div class="w-full sm:w-1/3">
                    <label class="block text-sm font-bold mb-1">Warna</label>
                    <input type="text" name="variants[${currentVariantIndex}][sizes][${sizeIndex}][warna]" required
                        placeholder="contoh: Merah"
                        class="block w-full bg-white border border-gray-300 rounded px-3 py-2">
                </div>
                <div class="w-full flex justify-end mt-2">
                    <button type="button" class="bg-red-400 text-white px-2 py-1 rounded" onclick="removeSize(this)">Hapus Ukuran</button>
                </div>
            </div>
        `;

            sizeContainer.insertAdjacentHTML('beforeend', sizeHTML);
        }

        function removeVariant(button) {
            const variant = button.closest('.variant');
            variant.remove();
            updateIndexes();
        }

        function removeSize(button) {
            const size = button.closest('.size');
            size.remove();
            updateIndexes();
        }

        // Fungsi untuk perbaiki indeks setelah hapus
        function updateIndexes() {
            const variants = document.querySelectorAll('.variant');
            variantIndex = variants.length;

            variants.forEach((variant, vIdx) => {
                // Update select dan subtotal
                variant.querySelectorAll('select, input[name*="subtotal"]').forEach(el => {
                    el.name = el.name.replace(/variants\[\d+]/, `variants[${vIdx}]`);
                });

                // Update size
                const sizes = variant.querySelectorAll('.size');
                sizes.forEach((size, sIdx) => {
                    size.querySelectorAll('input').forEach(input => {
                        input.name = input.name.replace(/variants\[\d+]\[sizes]\[\d+]/,
                            `variants[${vIdx}][sizes][${sIdx}]`);
                    });
                });
            });
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
