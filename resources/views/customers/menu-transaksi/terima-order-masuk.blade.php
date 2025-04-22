@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container sm:px-10 sm:py-5 w-full h-auto flex flex-col gap-8">
        @if ($data->status_pembayaran != 'Lunas')
            <div class="--warnging-alert w-fit p-2 rounded-lg bg-red-500/20 flex items-center gap-2">
                <div class="--icon"><i class="text-red-500 bi bi-exclamation-diamond-fill"></i></div>
                <p class="text-[14px] font-medium text-red-500">Status user Belum lunas, sebelum menyiapkan barang dan
                    menekan tombol terima, harap
                    menginputkan pembayaran di form Pembayaran COD!</p>
            </div>
        @else
            <div class="--warnging-alert w-fit p-2 rounded-lg bg-green-500/20 flex items-center gap-2">
                <div class="--icon"><i class="text-green-500 bi bi-exclamation-diamond-fill"></i></div>
                <p class="text-[14px] font-medium text-green-500">Status user <b>Lunas</b> anda bisa langsung menyiapkan
                    barang
                    sesuai dengan list pesanan user, dan menekan tombol terima!</p>
            </div>
        @endif
        @if ($data->status_penyewaan == 'Pending')
            <div>
                <button onclick="scrollToElement()"
                    class="hover:text-black p-2 rounded-full bg-[#F6D91F] border-black border-2 font-medium text-black">Terima
                    order disni!</button>
            </div>
        @endif
        <div class="--component-grid grid xl:grid-cols-2 gap-4">
            <div class="--component-1 flex flex-col gap-6">
                <div class="--information-user-order">
                    <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                        <div class="--header xl:text-[20px] font-bold">Informasi Client</div>
                        <div class="--body flex flex-col gap-4">
                            <div class="--foto-name-nomor-jenis-kalmin flex items-center justify-between">
                                <div class="--foto-name flex items-center gap-2">
                                    <img class="min-w-[40px] min-h-[40px] rounded-lg max-w-[60px] max-h-[60px] object-cover"
                                        src="{{ asset('assets/image/customers/profile/' . $data->foto) }}" alt="">
                                    <div class="--name font-medium">
                                        <p class="xl:text-[14px] text-gray-300">Nama Lengkap:</p>
                                        <p class="xl:text-[16px]">{{ $data->name }}</p>
                                    </div>
                                </div>
                                <div class="--nomor flex gap-2">
                                    <div><i class="bi bi-telephone-fill"></i></div>
                                    <div>
                                        <p class="xl:text-[14px] text-gray-300">Nomor Telephone:</p>
                                        <p class="xl:text-[16px]">{{ $data->nomor_telephone }}</p>
                                    </div>
                                </div>
                                <div class="--jenis-kelamin flex gap-2">
                                    <div><i class="bi bi-gender-male"></i></div>
                                    <div>
                                        <p class="xl:text-[14px] text-gray-300">Gender:</p>
                                        <p class="xl:text-[16px]">{{ $data->jenis_kelamin }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="--bank">
                                <p class="font-medium xl:text-[16px] mb-2">List Bank</p>
                                <div class="--wrapper-card-list-bank grid xl:grid-cols-2 gap-4">
                                    @foreach ($banks as $item)
                                        <div class="p-2 rounded-lg shadow-box-shadow-4 flex gap-4">
                                            <div>
                                                <p class="font-medium xl:text-[12px] text-gray-300">Bank:</p>
                                                <p class="font-medium xl:text-[14px]">{{ $item->bank }}</p>
                                            </div>
                                            <div>
                                                <p class="font-medium xl:text-[12px] text-gray-300">Rekening</p>
                                                <p class="font-medium xl:text-[14px]">{{ $item->rekening }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="--alamat">
                                <p class="font-medium xl:text-[16px] mb-1">Alamat</p>
                                <p>{{ $address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="--informasi-penyewaan">
                    <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                        <div class="--header xl:text-[20px] font-bold">Informasi Penyewaan</div>
                        <div class="--body">
                            <div class="--tanggal-mulai-selesai-status grid xl:grid-cols-3 items-center gap-4 mb-4">
                                <div class="--tanggal-mulai p-2 bg-green-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-calendar-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Tanggal Mulai:</p>
                                        <p class="text-[14px] font-bold">
                                            {{ Carbon\Carbon::parse($data->tanggal_mulai)->format('j M Y') }}</p>
                                    </div>
                                </div>
                                <div class="--tanggal-selesai p-2 bg-red-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-calendar-check-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Tanggal Selesai:</p>
                                        <p class="text-[14px] font-bold">
                                            {{ Carbon\Carbon::parse($data->tanggal_selesai)->format('j M Y') }}</p>
                                    </div>
                                </div>
                                <div class="--tanggal-selesai p-2 bg-orange-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-alarm-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Status:</p>
                                        <p class="text-[14px] font-bold">{{ $data->status_penyewaan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="--pesan p-2 rounded-lg flex gap-2 shadow-box-shadow-4">
                                <div><i class="bi bi-chat-square-quote-fill"></i></div>
                                <div>
                                    <p class="text-[12px] font-medium">Pesan:</p>
                                    <p class="text-[14px] font-bold">{{ $data->pesan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="--pembayaran-penyewaan">
                    <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                        <div class="--header xl:text-[20px] font-bold ">Informasi Pembayaran</div>
                        <div class="--body">
                            <div class="--wrapper-list-data grid grid-cols-3">
                                <div class="--bukti-pembayaran p-2 rounded-lg flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Bukti Pembyaran:</p>
                                    @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $data->bukti_pembayaran))
                                        <img class="w-full object-cover rounded-lg"
                                            src="{{ asset('assets/image/customers/pembayaran/' . $data->bukti_pembayaran) }}"
                                            alt="Bukti Jaminan">
                                    @else
                                        <p>{{ $data->jaminan_sewa }}</p>
                                    @endif
                                </div>
                                <div class="--bukti-jaminan p-2 rounded-lg flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Bukti Jaminan / No. KTP:</p>
                                    @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $data->jaminan_sewa))
                                        <img class="w-full object-cover rounded-lg"
                                            src="{{ asset('assets/image/customers/jaminan/' . $data->jaminan_sewa) }}"
                                            alt="Bukti Jaminan">
                                    @else
                                        <p>{{ $data->jaminan_sewa }}</p>
                                    @endif
                                </div>

                                <div class="--bukti-pembayaran p-2 rounded-lg  flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Jumlah Pembayaran:</p>
                                    <p class="font-black -mt-2 text-[20px]">Rp.
                                        {{ number_format($data->jumlah_pembayaran, 0, ',', '.') }}</p>
                                </div>
                                <div class="--bukti-pembayaran p-2 rounded-lg  flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Biaya Admin:</p>
                                    <p class="font-black -mt-2 text-[20px]">Rp.
                                        {{ number_format($data->biaya_admin, 0, ',', '.') }}</p>
                                </div>
                                <div class="--bukti-pembayaran p-2 rounded-lg  flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Total Pembayaran:</p>
                                    <p class="font-black -mt-2 text-[20px]">Rp.
                                        {{ number_format($data->total_pembayaran, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="--component-2">
                <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                    <div class="--header xl:text-[20px] font-bold ">Informasi Barang</div>
                    <div class="--body flex flex-col gap-4">
                        @foreach ($details as $id_produk => $detailGroup)
                            @php
                                $produk = $detailGroup->first();
                                $totalSubtotal = $detailGroup->sum('subtotal');
                            @endphp
                            <div class="--wrapper-card flex flex-col gap-2 p-2 rounded-lg shadow-box-shadow-4">
                                <div class="--image flex items-center gap-2">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->produk_foto) }}"
                                        alt="{{ $produk->produk_nama }}">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->foto_belakang) }}"
                                        alt="{{ $produk->produk_nama }}">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->foto_kiri) }}"
                                        alt="{{ $produk->produk_nama }}">
                                    <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/produk/' . $produk->foto_kanan) }}"
                                        alt="{{ $produk->produk_nama }}">
                                </div>
                                <div class="--name-kategori flex items-center gap-1">
                                    <p class="text-[20px] font-medium">{{ $produk->produk_nama }}</p>
                                    <p class="p-1 rounded-lg bg-green-500/20 text-[10px] font-bold text-green-500">
                                        {{ $produk->produk_kategori }}</p>
                                </div>
                                <div class="--variant-barang-dipesan flex flex-col gap-4">
                                    <p class="text-[12px] font-medium">Informasi variant barang dipesan.</p>
                                    <div class="--variant-barang">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Warna</th>
                                                    <th>Ukuran</th>
                                                    <th>Jumlah Dipesan</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detailGroup as $detail)
                                                    <tr>
                                                        <td class="text-[14px] font-medium">{{ $detail->warna_produk }}
                                                        </td>
                                                        <td class="text-[14px] font-medium">{{ $detail->ukuran }}</td>
                                                        <td class="text-[14px] font-medium">{{ $detail->qty }} Pcs</td>
                                                        <td class="text-[14px] font-medium">Rp.
                                                            {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-left text-[16px] font-medium">Total
                                                    </td>
                                                    <td colspan="" class="text-[16px] text-left font-medium">Rp.
                                                        {{ number_format($totalSubtotal, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="--component-pembayaran-form w-full {{ $data->status_pembayaran == 'Belum lunas' ? '' : 'hidden' }}">
            <div class="wrapper-content">
                <p class="text-[24px] font-bold">Inputkan Pembayaran Client</p>
                <p class="text-[14px] font-medium xl:w-1/2">Sebelum anda menekan tombol terima harap masukkan jumlah
                    pembayaran
                    dari client anda yang sebelumnya memesan
                    dengan metode COD, dan jangan lupa unutuk memberikan produk yang sesuai pesanan!</p>
                <div class="bg-orange-500/20 mt-4 mb-4 p-2 rounded-lg w-fit font-medium text-orange-500">Total harus
                    dibayarkan
                    client anda Rp. {{ number_format($harus_dibayar, 0, ',', '.') }}</div>
                {{-- @dump($data->id_penyewaan) --}}
                <div class="--input-pembayaran">
                    <form id="form-pembayaran-cod" class="flex flex-col gap-6"
                        action="{{ route('menu-transaksi.input-pembayaran-cod', ['id_penyewaan' => $data->id_penyewaan]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="harus_dibayar" value="{{ $harus_dibayar }}">
                        <input type="hidden" name="jumlah_pembayaran" id="jumlah_pembayaran_hidden">
                        <input type="hidden" name="kembalian_pembayaran" id="kembalian_pembayaran_hidden">
                        <input type="hidden" name="kurang_pembayaran" id="kurang_pembayaran_hidden">
                        <input type="hidden" name="total_pembayaran" id="total_pembayaran_hidden">
                        <div class="grid xl:grid-cols-2 gap-4">
                            <div class="--input-jumlah-pembayaran">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Jumlah Pembayaran
                                </label>
                                <input id="jumlah_pembayaran"
                                    class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" placeholder="Jumlah bayar">
                            </div>
                            <div class="--input-kembalian-pembayaran">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Kembalian Pembayaran
                                </label>
                                <input readonly id="kembalian_pembayaran"
                                    class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" placeholder="Kembalian bayar">
                            </div>
                            <div class="--input-kurang-pembayaran">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Kurang Pembayaran
                                </label>
                                <input readonly id="kurang_pembayaran"
                                    class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" placeholder="Kurang kembalian">
                            </div>
                            <div class="--input-total-pembayaran">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Total Pembayaran
                                </label>
                                <input readonly id="total_pembayaran"
                                    class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" placeholder="Total kembalian">
                            </div>
                            <div class="--input-total-pembayaran">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Jaminan Sewa
                                </label>
                                <input id="jaminan_sewa" name="jaminan_sewa"
                                    class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="file" placeholder="No. KTP / Lainnya">
                            </div>
                        </div>
                        <button id="simpan-pembayaran"
                            class="px-2 py-2 w-fit bg-blue-500 text-white text-[14px] font-medium rounded-lg">Simpan
                            Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
        @if ($data->status_penyewaan == 'Pending')
            <div class="--component-terima shadow-box-shadow-8 p-4 rounded-lg">
                <p class="font-medium text-[14px] mb-2 text-center">Jika dirasa sudah memenuhi anda maka tekan tombol
                    terima
                    dibawah ini,
                    dan waktu mulai dari penyewaan client akan berlangsung.</p>
                <form id="form-confirm-order"
                    action="{{ route('menu-transaksi.confirm-order-masuk', ['id_penyewaan' => $data->id_penyewaan, 'id_user' => Crypt::encrypt(session('id_user')), 'parameter' => 1]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex justify-center"><button id="terima-order"
                            {{ $data->status_pembayaran == 'Belum lunas' ? 'disabled' : '' }}
                            class="p-3 w-1/2 rounded-full {{ $data->status_pembayaran == 'Belum lunas' ? 'opacity-45' : '' }} bg-[#F6D91F] border-black border-2 font-medium text-black">Terima
                            Order</button></div>
                </form>
            </div>
        @elseif ($data->status_penyewaan == 'Pengembalian')
            <div class="--component-terima shadow-box-shadow-8 p-4 rounded-lg">
                <p class="font-medium text-[14px] mb-2 text-center">Jika dirasa sudah memenuhi anda maka tekan tombol
                    terima
                    dibawah ini,
                    dan client anda akan memiliki status selesai.</p>
                <form id="form-confirm-order"
                    action="{{ route('menu-transaksi.confirm-order-masuk', ['id_penyewaan' => $data->id_penyewaan, 'id_user' => Crypt::encrypt(session('id_user')), 'parameter' => 2]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex justify-center"><button id="terima-order"
                            {{ $data->status_pembayaran == 'Belum lunas' ? 'disabled' : '' }}
                            class="p-3 w-1/2 rounded-full {{ $data->status_pembayaran == 'Belum lunas' ? 'opacity-45' : '' }} bg-[#F6D91F] border-black border-2 font-medium text-black">Terima
                            Pengembalian Client</button></div>
                </form>
            </div>
        @endif
    </div>
    <script>
        var jumlah_pembayaran = document.getElementById('jumlah_pembayaran');
        var terimaOrder = document.getElementById('terima-order');
        var btnSimpanPembayaran = document.getElementById('simpan-pembayaran');
        if (localStorage.getItem('storageBtnClicked') === 'true') {
            terimaOrder.removeAttribute('disabled');
            terimaOrder.style.opacity = '1';
        }
        btnSimpanPembayaran.addEventListener('click', function(even) {
            even.preventDefault();
            var jumlahPembayaran = document.getElementById('jumlah_pembayaran_hidden').value;
            var jaminanSewa = document.getElementById('jaminan_sewa').value;
            if (jumlahPembayaran === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Anda belum memasukkan pembayaran COD Pelanggan!',
                });
            } else if (jaminanSewa === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap masukkan informasi KTP/Lainnya pelanggan untuk jaminan toko anda sendiri!',
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menyimpan pembayaran ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.setItem('storageBtnClicked', 'true');
                        terimaOrder.removeAttribute('disabled');
                        terimaOrder.style.opacity = '1';
                        document.getElementById('form-pembayaran-cod').submit();
                    }
                });
            }
        });

        terimaOrder.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Order',
                text: 'Setelah anda menerima order ini maka waktu dari penyewaan client ini akan berlangsung, dan jika client melakukan pengembalian maka status client adalah selesai!',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (localStorage.getItem('storageBtnClicked') !== null) {
                        localStorage.removeItem('storageBtnClicked');
                    }
                    document.getElementById('form-confirm-order').submit();
                }
            });
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        jumlah_pembayaran.addEventListener('input', function(e) {
            var input = this.value.replace(/[^0-9]/g, '');
            var formatted = formatRupiah(input, 'Rp. ');

            // Update value on the input field
            this.value = formatted;

            // Update hidden field with the unformatted number
            var jumlahPembayaran = parseInt(input, 10);
            document.getElementById('jumlah_pembayaran_hidden').value = isNaN(jumlahPembayaran) ? '' :
                jumlahPembayaran;

            // Update kembalian, kurang, dan total pembayaran
            var harusDibayar = parseInt(document.getElementById('harus_dibayar').value.replace(/[^0-9]/g, ''),
                10) || 0;
            var kembalianPembayaran = jumlahPembayaran > harusDibayar ? jumlahPembayaran - harusDibayar : 0;
            var kurangPembayaran = jumlahPembayaran < harusDibayar ? harusDibayar - jumlahPembayaran : 0;
            var totalPembayaran = jumlahPembayaran;

            document.getElementById('kembalian_pembayaran').value = formatRupiah(kembalianPembayaran.toString(),
                'Rp. ');
            document.getElementById('kurang_pembayaran').value = formatRupiah(kurangPembayaran.toString(), 'Rp. ');
            document.getElementById('total_pembayaran').value = formatRupiah(totalPembayaran.toString(), 'Rp. ');

            document.getElementById('kembalian_pembayaran_hidden').value = kembalianPembayaran;
            document.getElementById('kurang_pembayaran_hidden').value = kurangPembayaran;
            document.getElementById('total_pembayaran_hidden').value = totalPembayaran;
        });

        function scrollToElement() {
            var element = document.getElementById('terima-order');
            element.scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
@endsection
