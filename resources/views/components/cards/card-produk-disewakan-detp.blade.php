<div class="_card-produk-disewakan shadow-box-shadow-46 flex flex-col gap-2 bg-white rounded-[20px] p-4 w-full">
    <div class="_header">
        <h1 class="text-[18px] font-bold">Produk Yang Disewakan</h1>
    </div>
    <div class="_body w-full flex flex-col gap-2">
        @foreach ($data_produk_limit as $item)
            <div
                class="_card w-full flex bg-[#F2F5FD] hover:bg-white items-center cursor-pointer p-2 rounded-[10px] justify-between">
                <div class="_field-foto-nama-stok-status flex justify-start gap-2">
                    <div class="_foto w-[50px] h-[50px] overflow-hidden rounded-[10px]">
                        <img class="object-cover" src="{{ asset('assets/image/customers/produk/shopping.webp') }}"
                            alt="">
                    </div>
                    <div class="_nama-status">
                        <div class="_nama flex justify-start gap-2">
                            <p class="text-[16px] text-[#343535] font-medium">
                                {{ $item->nama ? $item->nama : 'Backpack Camping' }}</p>
                            <p class="text-[12px] gradient-1 rounded-[5px] px-2 py-1 text-white font-medium">
                                {{ $item->status }}</p>
                        </div>
                        <div class="_stok text-[14px] text-[#8D95A9] font-medium">{{ $item->total_variants }} Total Stok
                            Produk</div>
                    </div>
                </div>
                <div class="_field-harga text-right">
                    <p class="text-[14px] text-[#343535] font-medium">Subtotal Barang</p>
                    <p class="text-[16px] text-[#343535] font-medium">Rp.
                        {{ number_format($item->total_harga_sewa, 0, ',', '.') }}</p>
                </div>
                <div class="_action w-[35px] h-[35px] bg-blue-300 rounded-full flex justify-center items-center">
                    <i class="text-[18px] mt-1 text-blue-700 fi fi-rr-angle-small-right"></i>
                </div>
            </div>
        @endforeach

    </div>
    <div class="_footer flex justify-end">
        <p class="text-[14px] cursor-pointer font-medium text-blue-700 underline"><a
                href="{{ route('detail-pengguna.produk-disewakan', $name) }}">Lihat Lainnya!</a></p>
    </div>
</div>
