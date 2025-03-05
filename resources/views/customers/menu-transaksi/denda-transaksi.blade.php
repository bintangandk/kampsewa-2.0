@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container p-4 flex items-center justify-center w-full h-auto">
        <div>
            <img class="w-full object-cover" src="{{ asset('assets/vector/Working from anywhere-cuate.svg') }}" alt="">
            <p class="text-center text-[40px] font-black text-[#FFC727]">Fitur Sedang Dikerjakan!</p>
            <p class="text-[20px] font-medium text-center">Halo, Kampers saat ini fitur denda masih dalam pengerjaan, tunggu saja dan check terus notifikasi di emailmu!</p>
        </div>
    </div>
@endsection
