<div class="max-w-sm p-6 bg-white rounded-[20px] dark:bg-gray-800 dark:border-gray-700">
    <div class="w-[50px] h-[50px] bg-[#EFF2F7] flex justify-center items-center rounded-full">
        <i class="mt-2 text-[20px] text-[#3C50E0] fi fi-rr-shop"></i>
    </div>
    <div class="mt-3">
        <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $total_mitra }} +</h5>
    </div>
    <div class="w-full flex justify-between items-center">
        <p class="font-normal text-[14px] text-gray-900 dark:text-white">Total Mitra</p>
        @if ($percentageMitraChange >= 0)
            <p class="font-normal text-[14px] text-[#65D2AE]">
                {{ $percentageMitraChange }}% <i class="mt-2 fi fi-rr-arrow-small-up"></i>
            </p>
        @else
            <p class="font-normal text-[14px] text-red-500">
                {{ abs($percentageMitraChange) }}% <i class="mt-2 fi fi-rr-arrow-small-down"></i>
            </p>
        @endif
    </div>
    <button class="w-full p-[8px] rounded-[15px] gradient-1 mt-4 text-[14px] font-normal text-white">
        <a href="{{ route('kelola-pengguna.index') }}">Detail</a>
    </button>
</div>
