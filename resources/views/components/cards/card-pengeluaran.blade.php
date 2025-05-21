{{-- todo container card --}}
<div class="_card-expenses relative bg-white rounded-[20px] w-full">
    <div class="_wrapper-content-card h-full grid bg-white rounded-[20px] grid-cols-1 p-[1rem] justify-between w-full">

        {{-- todo bagian title card --}}
        <div class="w-full flex justify-between items-center">
            <div class="w-auto">
                <p class="text-[#343B7C] text-[16px]">Pengeluaran</p>
                <div class="flex gap-[10px] items-center">
                    <h1 class="text-[#343B7C] text-[24px]">Rp. {{ $total_pengeluaran_bulan_ini }}</h1>
                    <div class="p-[5px] bg-[#D6FFF3] rounded-full">
                        {{-- <p class="font-medium text-[#1ED0A6] text-[12px]">{{ $percentagePengeluaranChange }}%</p> --}}
                    </div>
                </div>
            </div>
            <div
                class="_icon-more flex justify-center items-center cursor-pointer w-[35px] h-[35px] bg-[#F2F5FD] hover:bg-[#CFDCFF] rounded-full">
                <a href="{{ route('pengeluaran.index') }}"><i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>

        {{-- todo bagian statistic card --}}
        <div class="_static">
            <p class="text-[12px] mb-[10px] text-[#343B7C]">Bulan {{ Carbon\Carbon::now()->subMonth()->format('F') }}
                <strong>Rp. {{ $pengeluaran_bulan_lalu }}</strong>
            </p>
            <div class="w-full h-[40px] bg-[#F2F5FD] rounded-[10px]">
                <div
                    class="w-[{{ $percentagePengeluaranChange }}%] bg-corak-2 flex justify-center items-center rounded-[10px] h-full">
                    <p class="text-white font-medium text-[16px]">{{ $percentagePengeluaranChange }}%</p>
                </div>
            </div>
        </div>
    </div>
</div>
