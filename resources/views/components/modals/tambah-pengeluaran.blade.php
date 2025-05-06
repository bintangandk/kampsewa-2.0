<div id="modal-tambah-pengeluaran-customer" class="hidden">
    <div
        class="_container w-full h-screen flex justify-center items-center z-20 fixed top-0 left-0 bg-white/0 backdrop-blur-sm">
        <div
            class="_card w-[500px] flex flex-col h-[500px] overflow-clip bg-white p-[20px] rounded-[20px] shadow-box-shadow-11">
            <div class="_header w-full">
                <div class="_title flex items-center gap-2">
                    <div class="w-[35px] h-[35px] rounded-full flex justify-center items-center text-white gradient-1"><i
                            class="bi bi-currency-bitcoin"></i></div>
                    <span class="text-[16px] font-bold">Tambah Pengeluaran</span>
                </div>
                <div class="_close"></div>
            </div>
            <div class="_body w-full mt-4 flex-grow p-2 overflow-y-auto">

                @if (Auth::user()->type == '0')
                    <form method="POST" id="form-tambah-pengeluaran"
                        action="{{ route('keuangan.tambah-pengeluaran-customer', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                        class="w-full flex flex-col gap-2">
                    @else
                        <form method="POST" id="form-tambah-pengeluaran"
                            action="{{ route('keuangan.tambah-pengeluaran-developer', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                            class="w-full flex flex-col gap-2">
                @endif
                {{-- <form method="POST" id="form-tambah-pengeluaran"
                    action="{{ route('keuangan.tambah-pengeluaran-customer', ['id_user' => Crypt::encrypt(session('id_user'))]) }}"
                    class="w-full flex flex-col gap-2"> --}}
                @csrf
                <input type="hidden" name="id_user" value="{{ session('id_user') }}">
                <div class="_input w-full">
                    <label for="fullname">Sumber</label>
                    <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        placeholder="Masukkan sumber pemasukan" type="text" id="sumber_pengeluaran_customer"
                        name="sumber" required>
                </div>
                <div class="_input w-full">
                    <label for="number_phone">Deskripsi</label>
                    <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        placeholder="Masukkan deskripsi pemasukan" type="text" id="deskripsi_pengeluaran_customer"
                        name="deskripsi" required>
                </div>
                <div class="_input w-full">
                    <label for="password">Nominal</label>
                    <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        placeholder="Masukkan nominal pemasukan" type="number" id="nominal_pengeluaran_customer"
                        name="nominal" required>
                </div>
                </form>
            </div>
            <hr>
            <div class="_footer w-full p-2 flex gap-2">
                <button id="tambah-pengeluaran"
                    class="gradient-1 text-white text-[14px] py-2 px-4 rounded-full">Simpan</button>
                <button class="text-[14px] shadow-box-shadow-8 py-2 px-4 rounded-full"
                    id="cancel-tambah-pengeluaran-web-customer">Cancel</button>
            </div>
        </div>
    </div>
</div>
