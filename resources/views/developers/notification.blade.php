@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container w-full p-[20px] flex flex-col gap-[10px]">

        {{-- todo wrapper feedback --}}
        <div class="_wrapper-feedback w-full grid grid-cols-[2fr_1fr] gap-[10px] h-[600px]">
            {{-- todo container feedback --}}
            @include('components.cards.card-feedback')

            {{-- todo card feedback sudah dibalas --}}
            @include('components.cards.card-feedback-dibalas')
        </div>

        {{-- todo wrapper required promotion --}}
        <div class="_wrapper-required-promotion">

            {{-- todo table list required promotion --}}
            <div class="_table w-full bg-white rounded-[20px] max-h-[700px] h-[700px] overflow-hidden py-[30px] px-[20px]">
                <div class="_heading-btn w-full flex justify-between items-center">
                    <div class="_heading">
                        <p class="text-[20px] font-bold">Promosi Iklan</p>
                    </div>
                    <div class="_btn">
                        <button><a href="" class="text-white gradient-1 text-[14px] p-2 rounded-[10px]">Kelola
                                Iklan</a></button>
                    </div>
                </div>
                <div class="_table mt-8 w-full overflow-x-scroll p-1 overflow-y-scroll max-h-full">
                    <table class="w-full text-left">
                        <thead class="text-left">
                            <tr>
                                <th class="p-[20px] bg-[#EFF2F7] font-medium w-[1/5] rounded-tl-[20px] rounded-bl-[20px]">
                                    Customer</th>
                                <th class="p-[20px] bg-[#EFF2F7] font-medium w-[1/5]">Judul Iklan</th>
                                <th class="p-[20px] bg-[#EFF2F7] font-medium w-[1/5]">Harga Iklan</th>
                                <th class="p-[20px] bg-[#EFF2F7] font-medium w-[1/5]">Status Pembayaran</th>
                                <th class="p-[20px] bg-[#EFF2F7] font-medium w-[1/5]">Status Iklan</th>
                                <th class="p-[20px] bg-[#EFF2F7] font-medium w-[1/5] rounded-tr-[20px] rounded-br-[20px]">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            @for ($i = 1; $i <= 10; $i++)
                                <tr class="border-b">
                                    <td class="p-[20px] w-[1/5]">
                                        <div class="flex gap-4 items-center">
                                            <div class="_foto rounded-full"><img
                                                    class="size-[40px] object-cover rounded-full"
                                                    src="{{ asset('assets/image/jokowi.jpg') }}" alt=""></div>
                                            <div class="_title">
                                                <p class="font-bold max-w-[250px] truncate">Jokowi Dodo</p>
                                                <p class="text-[12px] font-medium">Kota Banyuwangi</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-[20px] w-[1/5] max-w-[250px] truncate">Diskon 40% Semua Jenis Tenda
                                        Berkualitas</td>
                                    <td class="p-[20px] w-[1/5] max-w-[200px] truncate">Rp. 1.000.000</td>
                                    <td class="p-[20px] w-[1/5] max-w-[200px] truncate">Sudah Lunas</td>
                                    <td class="p-[20px] w-[1/5] max-w-[200px] truncate">Belum Aktif</td>
                                    <td class="w-[1/5]"><a href=""><i
                                                class="text-[20px] text-[#3C50E0] cursor-pointer fi fi-rr-file-circle-info"></i></a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <div class="w-full h-[50px]"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
@endsection
