<div id="modal" class="hidden">
<div
    class="_container w-full h-screen flex justify-center items-center z-20 fixed top-0 left-0 bg-white/0 backdrop-blur-sm">
    <div
        class="_card w-[500px] flex flex-col h-[500px] overflow-clip bg-white p-[20px] rounded-[20px] shadow-box-shadow-11">
        <div class="_header w-full">
            <div class="_title flex items-center gap-2">
                <div class="w-[35px] h-[35px] rounded-full flex justify-center items-center text-white gradient-1"><i
                        class="mt-1 fi fi-rr-user-add"></i></div>
                <span class="text-[16px] font-bold">Tambah Customer</span>
            </div>
            <div class="_close"></div>
        </div>
        <div class="_body w-full mt-4 flex-grow p-2 overflow-y-auto">
            <form action="" class="w-full flex flex-col gap-2">
                @csrf
                <div class="_input w-full">
                    <label for="fullname">Nama Lengkap</label>
                    <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        placeholder="Masukkan Nama Lengkap" type="text" id="fullname" name="fullname" required>
                </div>
                <div class="_input w-full">
                    <label for="number_phone">Nomor Telfon</label>
                    <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        placeholder="Masukkan Nomor Telfon" type="number" id="number_phone" name="number_phone"
                        required>
                </div>
                <div class="_input w-full">
                    <label for="password">Password</label>
                    <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        placeholder="Masukkan Password" type="text" id="password" name="password" required>
                </div>
                <div class="_input w-full">
                    <label for="date_of_birth">Tanggal Lahir</label>
                    <input class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        placeholder="Masukkan Tanggal Lahir" type="date" id="date_of_birth" name="date_of_birth"
                        required>
                </div>
                <div class="_input w-full">
                    <label for="gender">Jenis Kelamin</label>
                    <select name="gender" class="border w-full border-solid rounded-[10px] text-[14px] p-2"
                        id="gender">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="_input w-full mt-2">
                    <p class="mb-2">Upload Photo</p>
                    <label for="photo" class="w-full rounded-[10px] h-[200px] border-dashed border-2 flex items-center justify-center cursor-pointer">
                        <img class="w-full object-cover hidden" src="" alt="">
                        <div
                            class="_photo w-full flex flex-col items-center justify-center">
                            <p><i class="fi fi-rr-picture text-[28px]"></i></p>
                            <p>Upload foto klik <u>disini!</u></p>
                            <p class="text-[12px]">Format foto didukung JPG, PNG. Ukuran maksimal 10 MB</p>
                        </div>
                    </label>
                    <input type="file" name="photo" id="photo" class="hidden">
                </div>
            </form>
        </div>
        <hr>
        <div class="_footer w-full p-2 flex gap-2">
            <button class="gradient-1 text-white text-[14px] py-2 px-4 rounded-full">Simpan</button>
            <button class="text-[14px] shadow-box-shadow-8 py-2 px-4 rounded-full" onclick="modalHandler(false)">Cancel</button>
        </div>
    </div>
</div>
</div>
