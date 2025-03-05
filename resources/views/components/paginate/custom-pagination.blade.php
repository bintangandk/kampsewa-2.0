@if ($paginator->hasPages())
    <div class="_pagination">
        <div class="w-full flex justify-center pt-1 gap-2">
            {{-- Tautan Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <p><a href="#" class="text-[12px] font-bold text-white gradient-1 px-4 py-2 rounded-[5px]">Sebelumnya</a></p>
            @else
                <p><a href="{{ $paginator->previousPageUrl() }}" class="text-[12px] font-bold text-white gradient-1 px-4 py-2 rounded-[5px]">Sebelumnya</a></p>
            @endif

            {{-- Tautan Halaman --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <p><a href="#" class="text-[12px] font-bold text-black bg-white hover:bg-gray-100 shadow-box-shadow-8 px-4 py-2 rounded-[5px]">{{ $element }}</a></p>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <p><a href="#" class="text-[12px] font-bold text-black bg-white hover:bg-gray-100 shadow-box-shadow-8 px-4 py-2 rounded-[5px]">{{ $page }}</a></p>
                        @else
                            <p><a href="{{ $url }}" class="text-[12px] font-bold text-black bg-white hover:bg-gray-100 shadow-box-shadow-8 px-4 py-2 rounded-[5px]">{{ $page }}</a></p>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tautan Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <p><a href="{{ $paginator->nextPageUrl() }}" class="text-[12px] font-bold text-white gradient-1 px-4 py-2 rounded-[5px]">Next</a></p>
            @else
                <p><a href="#" class="text-[12px] font-bold text-white gradient-1 px-4 py-2 rounded-[5px]">Next</a></p>
            @endif
        </div>
    </div>
@endif
