<div class="max-w-sm p-6 bg-white rounded-[20px] dark:bg-gray-800 dark:border-gray-700">
    <div class="w-[50px] h-[50px] bg-[#EFF2F7] flex justify-center items-center rounded-full"><i
            class="mt-2 text-[20px] text-[#3C50E0] fi fi-rr-feedback"></i></div>
    <div class="mt-3">
        <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $total_feedback }} +</h5>
    </div>
    <div class="w-full flex justify-between items-center">
        <p class="font-normal text-[14px]">Total Feedback</p>
        @if ($percentageFeedbackChange >= 0)
            <p class="font-normal text-[14px] text-[#65D2AE]">
                {{ $percentageFeedbackChange }}% <i class="mt-2 fi fi-rr-arrow-small-up"></i>
            </p>
        @else
            <p class="font-normal text-[14px] text-red-500">
                {{ abs($percentageFeedbackChange) }}% <i class="mt-2 fi fi-rr-arrow-small-down"></i>
            </p>
        @endif
    </div>
    <button class="w-full p-[8px] rounded-[15px] gradient-1 mt-4 text-[14px] font-normal text-white"><a
            href="{{ route('notification.index') }}">Detail</a></button>
</div>
