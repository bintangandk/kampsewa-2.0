{{-- todo container feedback --}}
<div
    class="_component1 overflow-clip w-full flex flex-col gap-4 overflow-y-auto bg-white rounded-[20px] p-[20px] h-full">

    <div class="">
        {{-- todo wrapper judul, search & filter --}}
        <div class="_wrapper-heading-search-filter flex justify-between items-center">
            <div class="_heading">
                <h1 class="text-[20px] font-bold">Data Feedback</h1>
            </div>

            {{-- todo search komponent --}}
            <div class="_search-filter flex items-center gap-[10px]">
                <div class="_search">
                    <form class="form">
                        <label for="search">
                            <input class="input" type="text" required="" placeholder="Cari kata" id="search">
                            <div class="fancy-bg"></div>
                            <div class="search">
                                <svg viewBox="0 0 24 24" aria-hidden="true"
                                    class="r-14j79pv r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-4wgw6l r-f727ji r-bnwqim r-1plcrui r-lrvibr">
                                    <g>
                                        <path
                                            d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <button class="close-btn" type="reset">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </label>
                    </form>
                </div>

                {{-- todo filter komponent --}}
                <div class="_filter">
                    <div class="flex items-center justify-center">
                        <div class="relative inline-block text-left">
                            <button id="dropdown-button"
                                class="flex items-center gap-[5px] justify-center w-full px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                <i class="mt-[2px] text-[14px] fi fi-rr-settings-sliders"></i>
                                <p class="text-[14px]">Filter</p>
                            </button>
                            <div id="dropdown-menu"
                                class="origin-top-right absolute hidden right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
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
        </div>

        {{-- todo wrapper action : check all, reply, delete --}}
        <div class="_wraper-action mt-8 flex justify-between items-center">
            <div class="_checkbox-button-all flex items-center gap-2">

                {{-- todo checkbox komponent --}}
                <div class="_checkbox">
                    <div class="inline-flex items-center">
                        <label class="relative flex items-center rounded-full cursor-pointer" htmlFor="checkbox">
                            <input type="checkbox"
                                class="before:content[''] peer relative w-7 h-7 cursor-pointer appearance-none rounded-lg border-2 border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-[#5038ED] checked:bg-[#5038ED] checked:before:bg-gray-900 hover:before:opacity-10"
                                id="checkbox" />
                            <span
                                class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor" stroke="currentColor" stroke-width="1">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </label>
                    </div>
                </div>

                {{-- todo button component --}}
                <a class="_button">
                    <a href="" class="text-[14px] py-2 gradient-1 px-4 rounded-[7px] text-white">Balas
                        Semua</a>
                </a>
            </div>

            {{-- todo trash icon button komponent --}}
            <div class="_delete-icon-button relative"></div>
            <a class="_button">
                <a href=""
                    class="w-9 h-9 py-2 px-4 rounded-[7px] flex hover:bg-[#EF4444] hover:text-white justify-center items-center bg-[#FEF2F2] text-[#EF4444] text-[20px]"><i
                        class="mt-1 fi fi-rr-trash"></i></a>
            </a>
        </div>
    </div>

    {{-- todo container utama list data card --}}
    <div class="w-full overflow-y-auto p-2">

        {{-- todo wrapper card list feedback --}}
        <div class="_wrapper-card-list-feedback h-full w-full grid grid-cols-2 gap-2">

            {{-- todo list card feedback --}}
            @for ($i = 1; $i <= 10; $i++)
                <div
                    class="_card-list-feedback p-[10px] w-full flex flex-col gap-4 justify-between shadow-box-shadow-8 bg-white rounded-[20px]">

                    {{-- todo header card --}}
                    <div class="_header flex justify-between items-center">
                        <div class="_checkbox-rate flex items-center gap-2">
                            <div class="_checkbox">
                                <div class="inline-flex items-center">
                                    <label class="relative flex items-center rounded-full cursor-pointer"
                                        htmlFor="checkbox">
                                        <input type="checkbox"
                                            class="before:content[''] peer relative w-5 h-5 cursor-pointer appearance-none rounded-md border-2 border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-[#5038ED] checked:bg-[#5038ED] checked:before:bg-gray-900 hover:before:opacity-10"
                                            id="checkbox" />
                                        <span
                                            class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                stroke-width="1">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="_rate bg-yellow-100 flex items-center gap-1 px-2 py-1 rounded-[10px]">
                                <div class="_icon mt-1"><i class="text-yellow-500 fi fi-rr-star"></i></div>
                                <div class="_text text-yellow-500 text-[14px]">Baik</div>
                            </div>
                        </div>
                        <div class="_date flex items-center gap-2">
                            <i class="mt-1 fi fi-rr-clock-three"></i>
                            <p class="text-[14px] text-gray-500">20 Dec 2022</p>
                        </div>
                    </div>

                    {{-- todo body card --}}
                    <div class="_body">
                        Kalimat di atas menggambarkan pemikiran dengan jelas dan ringkas. Penggunaan bahasa yang
                        sederhana namun efektif membuatnya mudah dipahami. Semangat untuk terus berbagi!
                    </div>
                    <hr>

                    {{-- todo footer card --}}
                    <div class="_footer flex justify-between items-center">
                        <div class="_profile flex items-center gap-2">
                            <div class="_foto w-[40px] h-[40px] rounded-full overflow-hidden"><img
                                    class="object-cover w-full" src="{{ asset('assets/image/prabowo.jpg') }}"
                                    alt=""></div>
                            <div class="_name-alamat">
                                <p class="text-[14px] font-bold">Prabowo Subianto</p>
                                <p class="text-[12px] text-gray-500 font-medium">Kota Surabaya</p>
                            </div>
                        </div>
                        <div
                            class="_btn-send w-[40px] h-[40px] gradient-1 relative flex justify-center items-center rounded-full cursor-pointer">
                            <a href="" class="mt-1"><i
                                    class="text-white text-[14px] fi fi-rr-paper-plane"></i></a>
                        </div>
                    </div>
                </div>
            @endfor
            <div class="w-full h-[10px]"></div>
        </div>
    </div>

    {{-- todo penomoran pagination --}}
    <div class="w-full flex justify-center pt-1 gap-2">
        <p><a href=""
                class="text-[12px] font-bold text-white gradient-1 px-4 py-2 rounded-[5px]">Sebelumnya</a></p>
        <p><a href=""
                class="text-[12px] font-bold text-black hover:bg-gray-100 shadow-box-shadow-8 px-4 py-2 rounded-[5px]">1</a>
        </p>
        <p><a href=""
                class="text-[12px] font-bold text-black hover:bg-gray-100 shadow-box-shadow-8 px-4 py-2 rounded-[5px]">2</a>
        </p>
        <p><a href=""
                class="text-[12px] font-bold text-black hover:bg-gray-100 shadow-box-shadow-8 px-4 py-2 rounded-[5px]">3</a>
        </p>
        <p><a href=""
                class="text-[12px] font-bold text-black hover:bg-gray-100 shadow-box-shadow-8 px-4 py-2 rounded-[5px]">4</a>
        </p>
        <p><a href="" class="text-[12px] font-bold text-white gradient-1 px-4 py-2 rounded-[5px]">Next</a></p>
    </div>
</div>
