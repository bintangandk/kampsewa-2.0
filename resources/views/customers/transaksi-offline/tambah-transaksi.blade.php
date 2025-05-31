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
            <form id="formPenyewaan" enctype="multipart/form-data" class="w-full flex flex-col gap-6 h-auto mt-4">
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
                                    required class="bg-gray-200 rounded px-4 py-3 w-full subtotal" />
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
                    <button type="button" onclick="lanjutPembayaran()"
                        class="bg-green-600 text-white px-4 py-2 rounded text-sm">
                        Lanjut Pembayaran
                    </button>
                </div>
            </form>

            <!-- Modal Pembayaran -->
            <div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formPembayaran">
                            <div class="modal-header">
                                <h5 class="modal-title">Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body space-y-3">
                                <div>
                                    <label class="block text-sm font-bold">Metode Pembayaran</label>
                                    <select name="metode" class="form-select w-full bg-gray-200 rounded p-2" required>
                                        <option value="tunai">Tunai</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold">Jaminan Sewa</label>
                                    <input type="text" name="jaminan_sewa" class="w-full bg-gray-200 p-2 rounded"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-bold">Total Pembayaran</label>
                                    <input type="number" name="total_pembayaran" class="w-full bg-gray-200 p-2 rounded"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-bold">Jumlah Pembayaran</label>
                                    <input type="number" name="jumlah_pembayaran" class="w-full bg-gray-200 p-2 rounded"
                                        required />
                                </div>

                                <div>
                                    <label class="block text-sm font-bold">Kembalian</label>
                                    <input type="number" name="kembalian_pembayaran"
                                        class="w-full bg-gray-200 p-2 rounded" required />
                                </div>

                                <!-- Hidden values -->
                                <input type="hidden" name="biaya_admin" value="0" />
                                <input type="hidden" name="status_pembayaran" value="lunas" />
                                <input type="hidden" name="kurang_pembayaran" value="0" />
                                <input type="hidden" name="jenis_transaksi" value="offline" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="prosesPembayaran()">Proses
                                    Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>


    </div>


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
                        required class="bg-gray-200 rounded px-4 py-3 w-full subtotal" />
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
                    required class="bg-gray-200 rounded px-4 py-3 w-full subtotal" />
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

    {{-- <script>
        function lanjutPembayaran() {
            const modal = new bootstrap.Modal(document.getElementById('modalPembayaran'));
            modal.show();
        }

        function prosesPembayaran() {
            const formPenyewaan = document.getElementById('formPenyewaan');
            const formPembayaran = document.getElementById('formPembayaran');

            const formData = new FormData(formPenyewaan);

            // Tambahkan data dari modal
            const pembayaranData = new FormData(formPembayaran);
            for (const [key, value] of pembayaranData.entries()) {
                formData.append(key, value);
            }

            fetch("{{ route('transaksi-offline.post') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Transaksi berhasil ditambahkan') {
                        alert("Transaksi berhasil!");
                        location.reload(); // atau redirect sesuai kebutuhanmu
                    } else {
                        alert("Gagal menyimpan: " + data.message);
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("Terjadi kesalahan.");
                });
        }
    </script> --}}

    <script>
        function lanjutPembayaran() {
            const modal = new bootstrap.Modal(document.getElementById('modalPembayaran'));
            modal.show();
        }

        function prosesPembayaran() {
            const formPenyewaan = document.getElementById('formPenyewaan');
            const formPembayaran = document.getElementById('formPembayaran');

            const formData = new FormData(formPenyewaan);

            // Tambahkan data dari form modal
            const pembayaranData = new FormData(formPembayaran);
            for (const [key, value] of pembayaranData.entries()) {
                formData.append(key, value);
            }

            fetch("{{ route('transaksi-offline.post') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Transaksi Berhasil!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "{{ route('transaksi-offline.order-offline') }}";
                    });
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: error?.message || 'Gagal menyimpan transaksi.'
                    });
                });
        }
    </script>


    <script>
        // Fungsi menjumlahkan semua subtotal
        function hitungTotalPembayaran() {
            let total = 0;
            document.querySelectorAll('input.subtotal').forEach(function(el) {
                let val = parseInt(el.value) || 0;
                total += val;
            });

            const inputTotal = document.querySelector('input[name="total_pembayaran"]');
            if (inputTotal) {
                inputTotal.value = total;
            }

            hitungKembalian(); // update kembalian jika total berubah
        }

        // Fungsi hitung kembalian otomatis
        function hitungKembalian() {
            const total = parseInt(document.querySelector('input[name="total_pembayaran"]').value) || 0;
            const bayar = parseInt(document.querySelector('input[name="jumlah_pembayaran"]').value) || 0;
            const kembali = bayar - total;

            const inputKembali = document.querySelector('input[name="kembalian_pembayaran"]');
            if (inputKembali) {
                inputKembali.value = kembali >= 0 ? kembali : 0;
            }
        }

        // Event saat modal dibuka: hitung total terbaru
        document.getElementById('modalPembayaran').addEventListener('shown.bs.modal', function() {
            hitungTotalPembayaran();
        });

        // Event jika input jumlah pembayaran berubah
        document.querySelector('input[name="jumlah_pembayaran"]').addEventListener('input', hitungKembalian);

        // Delegasi event secara dinamis untuk semua input subtotal, termasuk yang baru ditambahkan
        document.addEventListener('input', function(e) {
            if (e.target && e.target.classList.contains('subtotal')) {
                hitungTotalPembayaran();
            }
        });
    </script>
@endsection
