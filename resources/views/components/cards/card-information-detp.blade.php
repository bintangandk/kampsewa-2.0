<div class="_component-information w-full gap-3 grid grid-cols-3">

    {{-- todo card jumlah transaksi dilakukan --}}
    <div
        class="_card-jumlah-transaksi-dilakukan shadow-box-shadow-46 cursor-pointer hover:shadow-box-shadow-7 flex flex-col gap-2 relative p-4 bg-gradient-to-tl to-[#9BEAC6] from-[#9FE9C5] w-full rounded-[20px]">
        <div class="_heading flex items-center justify-between">
            <div class="font-bold text-[#343535] text-[18px]">Jumlah Transaksi Sewa & Sewakan</div>
        </div>
        <div class="_body w-full flex flex-col gap-2">
            <div class="_jumlah-transaksi-sewa">
                <p class="font-medium text-[16px] text-[#343535]">Sewa</p>
                <p class="text-[14px] font-medium text-[#343535]">43 Transaksi</p>
            </div>
            <div class="_jumlah-transaksi-sewakan">
                <p class="font-medium text-[16px] text-[#343535]">Sewakan</p>
                <p class="text-[14px] font-medium text-[#343535]">Belum Ada Transaksis</p>
            </div>
        </div>
        <div class="_footer border-t-2 border-black">
            <div class="_user-terkait justify-end gap-1 flex mt-4 items-center">
                @for ($i = 1; $i <= 2; $i++)
                    <img class="rounded-full w-[35px] h-[35px] object-cover"
                        src="{{ asset('assets/image/prabowo.jpg') }}" alt="">
                @endfor
                <div
                    class="w-[35px] h-[35px] bg-[#323333] rounded-full flex justify-center items-center text-white text-[12px]">
                    76+</div>
            </div>
        </div>
    </div>

    {{-- todo card jumlah barang diposting --}}
    <div
        class="_card-jumlah-barang-diposting cursor-pointer flex flex-col gap-2 p-4 shadow-box-shadow-46 bg-gradient-to-tr to-[#F6AEE4] hover:shadow-box-shadow-7 from-[#F1C0F5] rounded-[20px]">
        <div class="_header">
            <h1 class="text-[18px] font-bold text-[#343535]">Jumlah Barang Disewakan</h1>
        </div>
        <div class="_body flex justify-start">
            <p class="{{ $data->total_product ? 'text-[40px] text-[#343535]' : 'text-[14px] text-red-500' }} font-bold">{{ $data->total_product ? $data->total_product : 'Belum Diisi' }}</p>
        </div>
        <div class="_footer">
            <p class="text-[14px] font-medium text-[#343535]">Total barang yang diposting dari meja, kursi
                dan lainnya.</p>
        </div>
    </div>

    {{-- todo card --}}
    <div
        class="_card-test flex flex-col gap-2 bg-gradient-to-tr to-[#A5E2F9] rounded-[20px] p-4 shadow-box-shadow-46 hover:shadow-box-shadow-7 cursor-pointer from-[#A3E2FE]">
        <div class="_header">
            <p class="text-[18px] font-bold text-[#343535]">Feedback Terbaru Pengguna</p>
        </div>
        <div class="_body">
            <div class="flex items-center gap-1">
                <div class="mt-1"><i class="fi fi-rr-memo-pad"></i></div>
                <div class="text-[14px] font-medium text-[#343535]">Catatan : </div>
            </div>
            <div>
                <p class="text-[14px] font-medium text-[#343535] line-clamp-4">Lorem ipsum dolor sit amet
                    consectetur adipisicing elit. Excepturi qui accusamus illo exercitationem, voluptates
                    minus adipisci libero neque laudantium quod voluptatum reiciendis sunt id, nisi corrupti
                    obcaecati? Pariatur, laborum non.</p>
            </div>
        </div>
        <div class="_footer">
            <p class="text-[14px] font-bold text-blue-700 underline">Lihat Lainnya!</p>
        </div>
    </div>
</div>
