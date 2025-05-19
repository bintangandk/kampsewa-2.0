{{-- todo container card --}}
<div class="_card-kerugian flex justify-between p-[20px] w-full h-full bg-white rounded-[20px]">
    {{-- todo bagian kiri title card --}}
    <div class="_heading flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-[10px]">
                <div class="w-[25px] h-[25px] gradient-1 rounded-[5px]"></div>
                <p class="text-[#343B7C] text-[16px] font-medium">Kerugian</p>
            </div>
            <p class="text-[32px] font-medium font-poppins">Rp. {{ $total_kerugian_tahun_ini }}</p>
            <p class="text-[14px] mt-[10px] rounded-full w-fit p-[5px] text-center text-[#1ED0A6] bg-[#D6FFF3]">
                {{ date('Y') }}</p>
        </div>
        <div class="items-center gap-[10px] w-full"><a href="{{ route('rekap-keuangan.index') }}"
                class="text-center text-[12px] gradient-1 text-white rounded-[10px] p-[10px]">Details <i
                    class="fi fi-rr-angle-right"></i></a></div>
    </div>

    {{-- todo bagian canvas statistik chartjs --}}
    <div class="h-full flex justify-center items-center">
        <div class="_chart w-[100px] h-[100px] relative">
            {{-- <canvas class="" id="chart-kerugian"></canvas> --}}
        </div>
    </div>
</div>
