{{-- todo container card --}}
<div class="_card-income relative w-full gradient-1 overflow-hidden rounded-[20px]">

    {{-- todo image background --}}
    <img class="object-cover shadow-box-shadow-11 w-full h-full" src="{{ asset('assets/accessories/gradient 3-04 1 1.png') }}"
        alt="">

        {{-- todo content --}}
    <div
        class="_wrapper-content-card h-full grid grid-cols-1 justify-between w-full top-0 left-0 p-[1rem] absolute z-10">

        {{-- todo bagian title card --}}
        <div class="w-full flex justify-between items-center">
            <div class="w-auto">
                <p class="text-white text-[16px]">Penghasilan</p>
                <div class="flex gap-[10px] items-center">
                    <h1 class="text-white text-[24px]">Rp. {{ $pemasukan_bulan_ini }}</h1>
                    <div class="p-[5px] bg-[#F2F5FD] rounded-full">
                        <p class="font-medium text-[#2D53DA] text-[12px]">{{ $percentagePemasukanChange }}%</p>
                    </div>
                </div>
            </div>
            <div
                class="_icon-more flex justify-center items-center cursor-pointer w-[35px] h-[35px] bg-[#F2F5FD] hover:bg-[#CFDCFF] rounded-full">
                <a href="{{ route('penghasilan.index') }}"><i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>

        {{-- todo bagian statistic --}}
        <div class="_static">
            <p class="text-[12px] mb-[10px] text-white">Bulan {{ Carbon\Carbon::now()->subMonth()->format('F') }} <strong>Rp. {{ $pemasukan_bulan_lalu }}</strong></p>
            <div class="w-full h-[40px] bg-[#F2F5FD] rounded-[10px]">
                <div class="w-[{{ $percentagePemasukanChange }}%] bg-corak flex justify-center items-center rounded-[10px] h-full">
                    <p class="text-white font-medium text-[16px]">{{ $percentagePemasukanChange }}%</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=
