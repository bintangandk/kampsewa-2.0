@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container sm:px-10 sm:py-5 w-full h-auto flex flex-col gap-8">
        @if ($data->status_penyewaan == 'Aktif')
            <a href="{{ route('menu-transaksi.sewa-berlangsung', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                id="back-button" class="w-fit px-2 py-2 bg-red-500 text-white text-[14px] font-medium rounded-lg">Kembali</a>
        @elseif ($data->status_penyewaan == 'Pending')
            <a href="{{ route('menu-transaksi.index', ['id_user' => Crypt::encrypt(auth()->user()->id)]) }}"
                class="w-fit px-2 py-2 bg-red-500 text-white text-[14px] font-medium rounded-lg">Kembali</a>
        @elseif ($data->status_penyewaan == 'Selesai')
            <a href="{{ route('menu-transaksi.order-selesai', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                class="w-fit px-2 py-2 bg-red-500 text-white text-[14px] font-medium rounded-lg">Kembali</a>
        @else
            <a href="{{ route('menu-transaksi.sewa-ditolak', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                class="w-fit px-2 py-2 bg-red-500 text-white text-[14px] font-medium rounded-lg">Kembali</a>
        @endif

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
        {{-- @if ($data->status_penyewaan == 'Pending')
            <div>
                <button onclick="scrollToElement()"
                    class="hover:text-black p-2 rounded-full bg-[#F6D91F] border-black border-2 font-medium text-black">Terima
                    order disni!</button>
            </div>
        @endif --}}
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
                                    <p class="font-medium text-[14px]">Total Denda:</p>
                                    <p class="font-black -mt-2 text-[20px]">Rp.
                                        {{ number_format($data->total_denda, 0, ',', '.') ?? '0' }}</p>
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
                    <div class="--header xl:text-[20px] font-bold">Informasi Barang</div>
                    <div class="--body flex flex-col gap-4">
                        @foreach ($details as $id_produk => $detailGroup)
                            @php
                                $produk = $detailGroup->first();
                                $totalSubtotal = $detailGroup->sum('subtotal');
                            @endphp
                            <div class="--wrapper-card flex flex-col gap-2 p-2 rounded-lg shadow-box-shadow-4">
                                <!-- Bagian gambar dan info produk -->
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

                                <!-- Tabel variant barang dengan denda per variant -->
                                <div class="--variant-barang-dipesan flex flex-col gap-4">
                                    <p class="text-[12px] font-medium">Informasi variant barang dipesan.</p>
                                    <div class="--variant-barang">
                                        <table class="table w-full">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="text-left py-2 px-4">Warna</th>
                                                    <th class="text-left py-2 px-4">Ukuran</th>
                                                    <th class="text-left py-2 px-4">Jumlah</th>
                                                    <th class="text-left py-2 px-4">Subtotal</th>
                                                    @if ($data->status_penyewaan == 'Aktif')
                                                        <th class="text-left py-2 px-4">Denda</th>
                                                        <th class="text-left py-2 px-4">Keterangan</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detailGroup as $detail)
                                                    <tr class="border-b">
                                                        <td class="py-2 px-4">{{ $detail->warna_produk }}</td>
                                                        <td class="py-2 px-4">{{ $detail->ukuran }}</td>
                                                        <td class="py-2 px-4">{{ $detail->qty }} Pcs</td>
                                                        <td class="py-2 px-4">Rp.
                                                            {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                                        <form id="form-pembayaran-cod" class="flex flex-col gap-6"
                                                            action="{{ route('menu-transaksi.input-pembayaran-cod', ['id_penyewaan' => $data->id_penyewaan]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            @if ($data->status_penyewaan == 'Aktif')
                                                                {{-- <td class="py-2 px-4">
                                                                <input name="denda[{{ $detail->id_detail }}][denda]"
                                                                    class="denda-item w-full py-1 px-2 border rounded"
                                                                    type="text" placeholder="Rp. 0" value=""
                                                                    data-id-produk="{{ $id_produk }}"
                                                                    oninput="this.value = formatRupiah(this.value, 'Rp. '); updateTotalDendaPerProduk(); updateFormPembayaran();">

                                                            </td> --}}
                                                                <td class="py-2 px-4">
                                                                    {{-- @dump($detail->id_detail) --}}
                                                                    <input name="denda[{{ $detail->id_detail }}][denda]"
                                                                        class="denda-item w-full py-1 px-2 border rounded"
                                                                        type="text" placeholder="Rp. 0"
                                                                        value="{{ $detail->denda ?? '' }}"
                                                                        data-id-produk="{{ $id_produk }}"
                                                                        oninput="this.value = formatRupiah(this.value, 'Rp. '); updateTotalDendaPerProduk();">

                                                                </td>
                                                                <td class="py-2 px-4">
                                                                    <textarea name="keterangan[{{ $detail->id_detail }}]" class="w-full py-1 px-2 border rounded" rows="1"
                                                                        placeholder="Keterangan">{{ $detail->keterangan_denda ?? '' }}</textarea>
                                                                </td>
                                                            @endif
                                                    </tr>
                                                @endforeach
                                                <tr class="font-semibold">
                                                    <td colspan="3" class="text-right py-2 px-4">Total</td>
                                                    <td class="py-2 px-4">Rp.
                                                        {{ number_format($totalSubtotal, 0, ',', '.') }}</td>
                                                    @if ($data->status_penyewaan == 'Aktif')
                                                        {{-- <td class="py-2 px-4">
                                                            <div class="total-denda-produk text-sm text-red-600 font-semibold"
                                                                data-id="{{ $id_produk }}">
                                                                Total Denda
                                                            </div>
                                                        </td> --}}

                                                        <td></td>
                                                    @endif
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
                <div class="bg-orange-500/20 mt-4 mb-4 p-2 rounded-lg w-fit font-medium text-orange-500"
                    id="tampilan_harus_bayar">Total harus
                    dibayarkan
                    client anda Rp.
                    {{ number_format($data->kurang_pembayaran, 0, ',', '.') }}
                </div>
                {{-- @dump($data->id_penyewaan) --}}
                <div class="--input-pembayaran">

                    <input type="hidden" id="harus_dibayar" value="{{ $harus_dibayar }}">
                    {{-- <input type="hidden" name="jumlah_pembayaran" id="jumlah_pembayaran_hidden"> --}}
                    {{-- <input type="hidden" name="kembalian_pembayaran" id="kembalian_pembayaran_hidden"> --}}
                    <input type="hidden" name="kurang_pembayarann" id="kurang_pembayaran_hidden"
                        value="{{ $data->kurang_pembayaran }}">
                    <input type="hidden" name="total_pembayaran" id="total_pembayaran_hidden">
                    <div class="grid xl:grid-cols-2 gap-4">
                        <div class="--input-jumlah-pembayaran">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                Jumlah Pembayaran
                            </label>
                            <input id="jumlah_pembayaran"
                                class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Jumlah bayar" name="jumlah_pembayaran">
                        </div>
                        <div class="--input-kembalian-pembayaran">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                Kembalian Pembayaran
                            </label>
                            <input readonly id="kembalian_pembayaran"
                                class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Kembalian bayar" name="kembalian_pembayaran">
                        </div>
                        <div class="--input-kurang-pembayaran">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                Kurang Pembayaran
                            </label>
                            <input readonly id="kurang_pembayaran"
                                class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="" value="{{ $data->kurang_pembayaran }}"
                                name="kurang_pembayaran">
                        </div>
                        @if ($data->status_penyewaan == 'Aktif')
                            <div class="--input-kurang-pembayaran">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Total Denda
                                </label>

                                <input readonly id="total_denda"
                                    class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" placeholder="" name="total_denda">
                            </div>
                        @endif

                        <div class="--input-total-pembayaran">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                Total Pembayaran
                            </label>
                            <input readonly id="total_pembayaran"
                                class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="total_pembayaran" placeholder="Total Pembayaran"
                                value="{{ $data->kurang_pembayaran }}">
                        </div>
                        @if ($data->status_penyewaan == 'Pending')
                            <div class="--input-total-pembayaran">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Jaminan Sewa
                                </label>
                                <input id="jaminan_sewa" name="jaminan_sewa"
                                    class="-mt-3 shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="file" placeholder="No. KTP / Lainnya">
                            </div>
                        @endif
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
                <p class="font-medium text-[14px] mb-2 text-center">Silakan periksa kembali pesanan ini. Jika menurut Anda
                    pesanan sudah sesuai, tekan tombol Terima. Jika tidak sesuai, tekan tombol Tolak."</p>
                <form id="form-confirm-order"
                    action="{{ route('menu-transaksi.confirm-order-masuk', ['id_penyewaan' => $data->id_penyewaan, 'id_user' => Crypt::encrypt(session('id_user')), 'parameter' => 1]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex justify-center"><button id="terima-order" {{-- {{ $data->status_pembayaran == 'Belum lunas' ? 'disabled' : '' }} --}}
                            class="p-3 w-1/2 rounded-full 'opacity-45'  bg-[#F6D91F] border-black border-2 font-medium text-black">Terima
                            Order</button></div>


                </form>
                <form id="form-tolak-order"
                    action="{{ route('menu-transaksi.confirm-order-masuk', ['id_penyewaan' => $data->id_penyewaan, 'id_user' => Crypt::encrypt(session('id_user')), 'parameter' => 2]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex justify-center"><button id="tolak-order"
                            class="p-3 w-1/2 rounded-full bg-red-500 border-black border-2 font-medium text-white">Tolak
                            Order</button></div>
                </form>



            </div>
        @elseif ($data->status_penyewaan == 'Aktif')
            <div class="--component-terima shadow-box-shadow-8 p-4 rounded-lg">
                <p class="font-medium text-[14px] mb-2 text-center">Jika dirasa sudah memenuhi anda maka tekan tombol
                    terima
                    dibawah ini,
                    dan client anda akan memiliki status selesai.</p>
                <form id="form-confirm-order"
                    action="{{ route('menu-transaksi.confirm-order-masuk', ['id_penyewaan' => $data->id_penyewaan, 'id_user' => Crypt::encrypt(session('id_user')), 'parameter' => 3]) }}"
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
        // Hitung dan tampilkan total denda per produk
        // function updateTotalDendaPerProduk() {
        //     const semuaInputDenda = document.querySelector('.denda-item');
        //     const totalDendaPerProduk = {};

        //     console.log(semuaInputDenda);


        //     semuaInputDenda.forEach(input => {
        //         const idProduk = input.dataset.idProduk;
        //         const nilai = parseRupiah(input.value);
        //         if (!totalDendaPerProduk[idProduk]) {
        //             totalDendaPerProduk[idProduk] = 0;
        //         }
        //         totalDendaPerProduk[idProduk] += nilai;
        //     });

        //     // Update tampilannya
        //     document.querySelectorAll('.total-denda-produk').forEach(el => {
        //         const idProduk = el.dataset.id;
        //         const total = totalDendaPerProduk[idProduk] || 0;
        //         el.textContent = formatRupiah(total, '');
        //     });
        // }

        let initialKurangPembayaran = null;
        let initialTotal = null;



        function updateTotalDendaPerProduk() {
            const semuaInputDenda = document.querySelectorAll('.denda-item');
            let totalDenda = 0;

            semuaInputDenda.forEach((input, index) => {
                const nilai = parseRupiah(input.value);
                console.log(`Input ke-${index + 1}:`, nilai);
                totalDenda += nilai;
            });

            console.log("Total Denda:", totalDenda);
            updateForm(totalDenda);
        }



        function formatRupiah(angka, prefix) {

            if (!angka) return '';

            const number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            let hasil = rupiah;
            if (ribuan) {
                const separator = sisa ? '.' : '';
                hasil += separator + ribuan.join('.');
            }

            hasil = split[1] != undefined ? hasil + ',' + split[1] : hasil;
            return prefix == undefined ? hasil : (hasil ? 'Rp. ' + hasil : '');
        }

        function parseRupiah(rupiah) {
            return parseInt(rupiah.replace(/[^0-9]/g, '')) || 0;
        }



        function updateForm(totalDenda) {
            const componentPembayaran = document.querySelector('.--component-pembayaran-form');
            const kurangPembayaranInput = document.getElementById('kurang_pembayaran');
            const totalPembayaran = document.getElementById('total_pembayaran');
            var kurangPembayaranInputt = parseRupiah(document.getElementById('kurang_pembayaran_hidden').value);
            var harusDibayarAwal = document.getElementById('tampilan_harus_bayar');



            // Simpan nilai awal hanya sekali
            if (initialKurangPembayaran === null) {
                const value = kurangPembayaranInputt;
                initialKurangPembayaran = value;
                // console.log("Initial Kurang Pembayaran set ke:", initialKurangPembayaran);
            }

            const hasilAkhir = initialKurangPembayaran + totalDenda;

            // hitungPembayaran();
            if (totalDenda > 0) {
                componentPembayaran.classList.remove('hidden');
                kurangPembayaranInput.value = formatRupiah(hasilAkhir, 'Rp. ');

                kurangPembayaranInputt = hasilAkhir
                totalPembayaran.value = formatRupiah(hasilAkhir, 'Rp. ');
                // console.log("Kurang Pembayaran:", kurangPembayaranInputt);
                harusDibayarAwal.innerText = "Total harus dibayarkan oleh client anda Rp. " + hasilAkhir


                // console.log("Total harus dibayarkan:", harusDibayarAwal.value);


                document.getElementById('total_denda').value = formatRupiah(totalDenda, 'Rp. ');
            } else if (kurangPembayaranInputt === 0) {
                // Jika tidak ada denda, tampilkan nilai awal saja
                kurangPembayaranInput.value = kurangPembayaranInputt;
                document.getElementById('total_denda').value = 0;
                componentPembayaran.classList.add('hidden');
            } else {
                // Jika tidak ada denda, tampilkan nilai awal saja
                document.getElementById('total_denda').value = 0;
                kurangPembayaranInput.value = document.getElementById('kurang_pembayaran_hidden').value;
                totalPembayaran.value = formatRupiah(kurangPembayaranInput.value, 'Rp. ');
                // console.log("Kurang Pembayaran:", kurangPembayaranInputt);
                harusDibayarAwal.innerText = "Total harus dibayarkan oleh client anda Rp. " + kurangPembayaranInputt
            }


            // console.log("Hasil Akhir:", hasilAkhir);
        }
        // Fungsi utama yang akan dijalankan ketika dokumen siap


        // function hitungPembayaran() {
        //     const input = jumlah_pembayaran.value.replace(/[^0-9]/g, '');
        //     const formatted = formatRupiah(input, 'Rp. ');

        //     jumlah_pembayaran.value = formatted;
        //     // document.getElementById('jumlah_pembayaran_hidden').value = input || 0;

        //     // Ambil nilai denda
        //     const totalDenda = parseRupiah(document.getElementById('total_denda').value);
        //     const harusDibayarAwal = parseRupiah(document.getElementById('harus_dibayar').value);
        //     const KurangPembayaranawal = parseRupiah(document.getElementById('kurang_pembayaran').value);
        //     const KurangPembayaran = KurangPembayaranawal + totalDenda;
        //     const kembalianPembayaran = jumlahPembayaran > totalHarusDibayar ? jumlahPembayaran -
        //         totalHarusDibayar : 0;
        //     const kurangPembayaran = jumlahPembayaran < totalHarusDibayar ? totalHarusDibayar -
        //         jumlahPembayaran : 0;
        //     const totalPembayaran = jumlahPembayaran;

        //     // Update tampilan
        //     document.getElementById('kembalian_pembayaran').value = formatRupiah(kembalianPembayaran, 'Rp. ');
        //     document.getElementById('kurang_pembayaran').value = formatRupiah(KurangPembayaran, 'Rp. ');
        //     document.getElementById('total_pembayaran').value = formatRupiah(totalPembayaran, 'Rp. ');

        //     document.getElementById('kembalian_pembayaran_hidden').value = kembalianPembayaran;
        //     document.getElementById('kurang_pembayaran_hidden').value = kurangPembayaran;
        //     document.getElementById('total_pembayaran_hidden').value = totalPembayaran;
        // }


        document.addEventListener('DOMContentLoaded', function() {

            // Inisialisasi variabel
            const jumlah_pembayaran = document.getElementById('jumlah_pembayaran');
            const terimaOrder = document.getElementById('terima-order');
            const btnSimpanPembayaran = document.getElementById('simpan-pembayaran');
            const formPembayaran = document.getElementById('form-pembayaran-cod');
            const componentPembayaran = document.querySelector('.--component-pembayaran-form');

            // Format angka ke Rupiah


            // Hitung total denda untuk semua produk
            // function hitungTotalDenda() {
            //     let totalDenda = 0;
            //     const semuaInputDenda = document.querySelectorAll('.denda-item');

            //     semuaInputDenda.forEach(input => {
            //         totalDenda += parseRupiah(input.value);
            //     });

            //     // console.log(totalDenda);
            //     return totalDenda;

            // }

            // // Update form pembayaran berdasarkan denda
            // function updateFormPembayaran() {
            //     const totalDenda = hitungTotalDenda();


            //     // Tampilkan form pembayaran jika ada denda
            //     if (totalDenda > 0) {
            //         componentPembayaran.classList.remove('hidden');

            //         // Update harus dibayar (harga awal + denda)
            //         const harusDibayarAwal = parseRupiah(document.getElementById('harus_dibayar').value);
            //         const KurangPembayaranawal = parseRupiah(document.getElementById('kurang_pembayaran').value);
            //         const KurangPembayaran = KurangPembayaranawal + totalDenda;
            //         const totalHarusDibayar = harusDibayarAwal + totalDenda;
            //         document.getElementById('kurang_pembayaran').value = formatRupiah(KurangPembayaran, 'Rp. ');

            //         // Trigger perhitungan ulang
            //         if (jumlah_pembayaran.value) {
            //             hitungPembayaran();
            //         }
            //     } else {
            //         // Sembunyikan form pembayaran jika tidak ada denda
            //         componentPembayaran.classList.add('hidden');
            //     }
            // }
            // Update form pembayaran berdasarkan denda

            // Hitung pembayaran (kembalian/kurang)
            function hitungPembayaran() {
                const input = jumlah_pembayaran.value.replace(/[^0-9]/g, '');
                const formatted = formatRupiah(input, 'Rp. ');

                jumlah_pembayaran.value = formatted;
                // document.getElementById('jumlah_pembayaran_hidden').value = input || 0;

                // Ambil nilai denda

                // jumlah_pembayaran.value = formatted;

                const jumlahPembayaran = parseInt(input) || 0;



                const totalDenda = parseRupiah(document.getElementById('total_denda')?.value || "0");
                const harusDibayarAwal = parseRupiah(document.getElementById('harus_dibayar').value);
                const KurangPembayaranawal = parseRupiah(document.getElementById('kurang_pembayaran').value);
                const KurangPembayaranawall = parseRupiah(document.getElementById('kurang_pembayaran_hidden')
                    .value);
                const totalPembayaran = parseRupiah(document.getElementById('total_pembayaran').value);
                if (initialTotal === null) {
                    initialTotal = totalPembayaran;


                } else if (initialTotal !== totalPembayaran) {
                    initialTotal = totalPembayaran;

                }
                console.log(jumlahPembayaran - KurangPembayaranawal);
                if (jumlahPembayaran > initialTotal) {
                    var kembalianPembayaran = jumlahPembayaran - initialTotal;
                    var kurangPembayarann = 0;
                } else if (jumlahPembayaran < initialTotal) {
                    var kembalianPembayaran = 0;
                    var kurangPembayarann = initialTotal - jumlahPembayaran

                } else if (jumlahPembayaran == initialTotal) {
                    var kembalianPembayaran = 0;
                    var kurangPembayarann = 0
                } else if (jumlahPembayaran === "") {

                    KurangPembayaran = initialTotal
                }


                // const KurangPembayarann = KurangPembayaranawal + totalDenda;
                // const kembalianPembayaran = jumlahPembayaran > kurangPembayarann ? jumlahPembayaran -
                //     totalHarusDibayar : 0;
                // const kurangPembayaran = jumlahPembayaran < kurangPembayaran ? totalHarusDibayar -
                //     jumlahPembayaran : 0;
                // const totalPembayaran = jumlahPembayaran;

                // Update tampilan
                document.getElementById('kembalian_pembayaran').value = kembalianPembayaran;
                document.getElementById('kurang_pembayaran').value = kurangPembayarann;
                // document.getElementById('total_pembayaran').value = formatRupiah(KurangPembayaranawall, 'Rp. ');

                // document.getElementById('kembalian_pembayaran_hidden').value = kembalianPembayaran;
                // document.getElementById('kurang_pembayaran_hidden').value = kurangPembayaran;
                // document.getElementById('total_pembayaran_hidden').value = totalPembayaran;
            }



            // Event listener untuk jumlah pembayaran
            jumlah_pembayaran.addEventListener('input', hitungPembayaran);

            // Cek localStorage untuk tombol terima order
            if (localStorage.getItem('storageBtnClicked') === 'true') {
                terimaOrder.removeAttribute('disabled');
                terimaOrder.style.opacity = '1';
            }

            // Event listener untuk simpan pembayaran
            btnSimpanPembayaran.addEventListener('click', function(e) {
                e.preventDefault();

                const jumlahPembayaran = document.getElementById('jumlah_pembayaran').value;


                if (!jumlahPembayaran) {
                    Swal.fire('Error', 'Anda belum memasukkan pembayaran COD Pelanggan!', 'error');
                    return;
                }



                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menyimpan pembayaran ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.setItem('storageBtnClicked', 'true');
                        terimaOrder.removeAttribute('disabled');
                        terimaOrder.style.opacity = '1';
                        formPembayaran.submit();
                    }
                });
            });

            // Event listener untuk tombol terima order
            terimaOrder.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Konfirmasi Order',
                    text: 'Setelah anda menerima order ini maka waktu penyewaan akan berlangsung!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, terima!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.removeItem('storageBtnClicked');
                        document.getElementById('form-confirm-order').submit();
                    }
                });
            });

            // Fungsi scroll ke element
            function scrollToElement() {
                document.getElementById('terima-order').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            // Event listener untuk tolak order
            document.getElementById('tolak-order')?.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Tolak Order',
                    text: 'Apakah Anda yakin ingin menolak order ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, tolak!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-tolak-order').submit();
                    }
                });
            });

            // Cek awal apakah ada denda
            // updateFormPembayaran();
        });
    </script>
@endsection
