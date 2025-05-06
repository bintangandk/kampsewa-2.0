@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container sm:px-10 sm:py-5 w-full h-auto flex flex-col gap-8">
        <div class="--warnging-alert w-fit p-2 rounded-lg bg-green-500/20 flex items-center gap-2">
            <div class="--icon"><i class="text-green-500 bi bi-exclamation-diamond-fill"></i></div>
            <p class="text-[14px] font-medium text-green-500">Detail Transaksi Offline</p>
        </div>
        <div class="--component-grid grid xl:grid-cols-2 gap-4">
            <div class="--component-1 flex flex-col gap-6">
                <div class="--information-user-order">
                    <div class="--card p-4 shadow-box-shadow-8 flex flex-col gap-4">
                        <div class="--header xl:text-[20px] font-bold">Informasi Client</div>
                        <div class="--body flex flex-col gap-4">
                            <div class="--foto-name-nomor-jenis-kalmin flex items-center justify-between">
                                <div class="--foto-name flex items-center gap-2">
                                    <img class="min-w-[40px] min-h-[40px] rounded-lg max-w-[60px] max-h-[60px] object-cover"
                                        src="{{ asset('assets/image/customers/profile/') }}" alt="">
                                    <div class="--name font-medium">
                                        <p class="xl:text-[14px] text-gray-300">Nama Lengkap:</p>
                                        <p class="xl:text-[16px]"></p>
                                    </div>
                                </div>
                                <div class="--nomor flex gap-2">
                                    <div><i class="bi bi-telephone-fill"></i></div>
                                    <div>
                                        <p class="xl:text-[14px] text-gray-300">Nomor Telephone:</p>
                                        <p class="xl:text-[16px]"></p>
                                    </div>
                                </div>
                                <div class="--jenis-kelamin flex gap-2">
                                    <div><i class="bi bi-gender-male"></i></div>
                                    <div>
                                        <p class="xl:text-[14px] text-gray-300">Gender:</p>
                                        <p class="xl:text-[16px]"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="--bank">
                                <p class="font-medium xl:text-[16px] mb-2">List Bank</p>
                                <div class="--wrapper-card-list-bank grid xl:grid-cols-2 gap-4">
                                    <div class="p-2 rounded-lg shadow-box-shadow-4 flex gap-4">
                                        <div>
                                            <p class="font-medium xl:text-[12px] text-gray-300">Bank:</p>
                                            <p class="font-medium xl:text-[14px]"></p>
                                        </div>
                                        <div>
                                            <p class="font-medium xl:text-[12px] text-gray-300">Rekening</p>
                                            <p class="font-medium xl:text-[14px]"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="--alamat">
                                <p class="font-medium xl:text-[16px] mb-1">Alamat</p>
                                <p></p>
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
                                        </p>
                                    </div>
                                </div>
                                <div class="--tanggal-selesai p-2 bg-red-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-calendar-check-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Tanggal Selesai:</p>
                                        <p class="text-[14px] font-bold">
                                        </p>
                                    </div>
                                </div>
                                <div class="--tanggal-selesai p-2 bg-orange-500/20 rounded-lg flex gap-2">
                                    <div><i class="bi bi-alarm-fill"></i></div>
                                    <div>
                                        <p class="text-[12px] font-medium">Status:</p>
                                        <p class="text-[14px] font-bold"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="--pesan p-2 rounded-lg flex gap-2 shadow-box-shadow-4">
                                <div><i class="bi bi-chat-square-quote-fill"></i></div>
                                <div>
                                    <p class="text-[12px] font-medium">Pesan:</p>
                                    <p class="text-[14px] font-bold"></p>
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
                                    <img class="w-full object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/pembayaran/') }}" alt="Bukti Jaminan">
                                </div>
                                <div class="--bukti-jaminan p-2 rounded-lg flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Bukti Jaminan / No. KTP:</p>
                                    <img class="w-full object-cover rounded-lg"
                                        src="{{ asset('assets/image/customers/jaminan/') }}" alt="Bukti Jaminan">
                                </div>

                                <div class="--bukti-pembayaran p-2 rounded-lg  flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Jumlah Pembayaran:</p>
                                    <p class="font-black -mt-2 text-[20px]">Rp.
                                    </p>
                                </div>
                                <div class="--bukti-pembayaran p-2 rounded-lg  flex flex-col gap-2">
                                    <p class="font-medium text-[14px]">Total Pembayaran:</p>
                                    <p class="font-black -mt-2 text-[20px]">Rp.
                                    </p>
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
                        <div class="--wrapper-card flex flex-col gap-2 p-2 rounded-lg shadow-box-shadow-4">
                            <div class="--image flex items-center gap-2">
                                <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                    src="{{ asset('assets/image/customers/produk/') }}" alt="#">
                                <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                    src="{{ asset('assets/image/customers/produk/') }}" alt="#">
                                <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                    src="{{ asset('assets/image/customers/produk/') }}" alt="#">
                                <img class="w-[80px] h-[80px] object-cover rounded-lg"
                                    src="{{ asset('assets/image/customers/produk/') }}" alt="#">
                            </div>
                            <div class="--name-kategori flex items-center gap-1">
                                <p class="text-[20px] font-medium"></p>
                                <p class="p-1 rounded-lg bg-green-500/20 text-[10px] font-bold text-green-500">
                                </p>
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
                                            <tr>
                                                <td class="text-[14px] font-medium">Hitam</td>
                                                <td class="text-[14px] font-medium">42</td>
                                                <td class="text-[14px] font-medium">1 Pcs</td>
                                                <td class="text-[14px] font-medium">Rp.
                                                    100.000</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-left text-[16px] font-medium">Total
                                                </td>
                                                <td colspan="" class="text-[16px] text-left font-medium">Rp.
                                                    100.000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @elseif ($data->status_penyewaan == 'Pengembalian')
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
        @endif --}}
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
