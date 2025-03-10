<div class="_transaksi-menyewakan flex flex-col gap-4 w-full bg-white h-[500px] max-h-[500px]">
    <div class="_judul-filter flex justify-between items-center">
        <div class="_judul">
            <p class="text-[18px] font-medium">Riwayat Transaksi Menyewakan</p>
            <p class="text-[14px]">Transaksi barang yang disewakan ke customer lain yang sebelumnya telah
                dilakukan.</p>
        </div>
        {{-- todo filter --}}
        <div class="_filter">
            <div class="flex items-center justify-center">
                <div class="relative inline-block text-left">
                    <button id="dropdown-button"
                        class="flex items-center gap-[5px] justify-center w-full px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                        <i class="mt-[2px] text-[14px] fi fi-rr-settings-sliders"></i>
                        <p class="text-[14px]">Filter</p>
                    </button>
                    <div id="dropdown-menu"
                        class="origin-top-right z-10 absolute hidden right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-2 p-2" role="menu" aria-orientation="vertical"
                            aria-labelledby="dropdown-button">
                            <a class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="light"
                                    width="18px" class="mr-2">
                                    <path
                                        d="M19 9.199h-.98c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799H19c.552 0 1-.357 1-.799 0-.441-.449-.801-1-.801zM10 4.5A5.483 5.483 0 0 0 4.5 10c0 3.051 2.449 5.5 5.5 5.5 3.05 0 5.5-2.449 5.5-5.5S13.049 4.5 10 4.5zm0 9.5c-2.211 0-4-1.791-4-4 0-2.211 1.789-4 4-4a4 4 0 0 1 0 8zm-7-4c0-.441-.449-.801-1-.801H1c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799h1c.551 0 1-.358 1-.799zm7-7c.441 0 .799-.447.799-1V1c0-.553-.358-1-.799-1-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1zm0 14c-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1 .441 0 .799-.447.799-1v-1c0-.553-.358-1-.799-1zm7.365-13.234c.391-.391.454-.961.142-1.273s-.883-.248-1.272.143l-.7.699c-.391.391-.454.961-.142 1.273s.883.248 1.273-.143l.699-.699zM3.334 15.533l-.7.701c-.391.391-.454.959-.142 1.271s.883.25 1.272-.141l.7-.699c.391-.391.454-.961.142-1.274s-.883-.247-1.272.142zm.431-12.898c-.39-.391-.961-.455-1.273-.143s-.248.883.141 1.274l.7.699c.391.391.96.455 1.272.143s.249-.883-.141-1.273l-.699-.7zm11.769 14.031l.7.699c.391.391.96.453 1.272.143.312-.312.249-.883-.142-1.273l-.699-.699c-.391-.391-.961-.455-1.274-.143s-.248.882.143 1.273z">
                                    </path>
                                </svg> Light
                            </a>
                            <a class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="moon"
                                    width="18px" class="mr-2">
                                    <path
                                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z">
                                    </path>
                                </svg> Dark
                            </a>
                            <a class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="mr-2"
                                    viewBox="0 0 32 32" id="desktop">
                                    <path
                                        d="M30 2H2a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2h9.998c-.004 1.446-.062 3.324-.61 4h-.404A.992.992 0 0 0 10 29c0 .552.44 1 .984 1h10.03A.992.992 0 0 0 22 29c0-.552-.44-1-.984-1h-.404c-.55-.676-.606-2.554-.61-4H30a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM14 24l-.002.004L14 24zm4.002.004L18 24h.002v.004zM30 20H2V4h28v16z">
                                    </path>
                                </svg> System
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_wrapper-card overflow-x-auto p-1 flex flex-col gap-4">
        @for ($i = 0; $i < 10; $i++)
            <div class="_sub-wrapper w-full relative">
                <div
                    class="_action flex opacity-0 transition duration-300 hover:opacity-100 justify-center items-center gap-4 z-10 w-full h-full rounded-[10px] bg-white/0 backdrop-blur-sm absolute">
                    <p><a class="py-2 px-4 text-[14px] shadow-box-shadow-7 bg-[#F0FDF4] text-[#22C55E] rounded-full"
                            href="">Detail</a></p>
                    <p><a class="py-2 px-4 text-[14px] shadow-box-shadow-7 bg-[#FEF2F2] text-[#EF4444] rounded-full"
                            href="">Hapus</a></p>
                </div>
                <div
                    class="_card-design flex justify-between items-center p-6 w-full shadow-box-shadow-8 rounded-[10px]">
                    <div class="_header flex items-center gap-2">
                        <div class="_image-produk"><img class="object-cover w-[70px] h-[70px] rounded-[10px]"
                                src="{{ asset('assets/image/customers/produk/gerber.png') }}" alt="">
                        </div>
                        <div class="_namaproduk-customer-durationsewa flex-col flex gap-1">
                            <div class="_namaproduk text-[18px] font-medium line-clamp-1">Tang Multifungsi
                                Nipper Camping Terbaik</div>
                            <div class="_customer flex gap-2 items-center">
                                <div class="img"><img class="w-[30px] h-[30px] rounded-full object-cover"
                                        src="{{ asset('assets/image/developers/agung-kurniawan.jpg') }}" alt="">
                                </div>
                                <div class="_name-durationsewa flex gap-2 items-center">
                                    <p class="text-[14px]">Agung Kurniawan</p>
                                    <p class="text-[12px] p-2 bg-[#FEF2F2] w-fit text-[#F95050] rounded-full">
                                        7
                                        Hari</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="_body">
                        <div class="mt-1"><i class="text-[24px] fi fi-rr-angle-small-right"></i></div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
