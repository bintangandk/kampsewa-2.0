@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container w-full">
        {{-- todo untuk 4 card pengguna, feedback, transaksi dan mitra --}}
        <div class="_component1 p-[20px] gap-[10px] w-full grid grid-cols-4">
            {{-- todo card pengguna --}}
            @include('components.cards.card-totalpengguna')
            {{-- todo card feedback --}}
            @include('components.cards.card-totalfeedback')
            {{-- todo card transaksi --}}
            @include('components.cards.card-totaltransaksi')
            {{-- todo card mitra --}}
            @include('components.cards.card-totalmitra')
        </div>

        {{-- todo untuk 4 card penghasilan, pengeluaran, kerugian, keuntungan --}}
        <div class="_component2 px-[20px] gap-[10px] grid grid-cols-[2fr_1fr] w-full">
            <div class="grid grid-cols-2 grid-rows-2 gap-[10px]">
                {{-- todo card penghasilan --}}
                @include('components.cards.card-penghasilan')
                {{-- todo card pengeluaran --}}
                @include('components.cards.card-pengeluaran')
                {{-- todo card kerugian --}}
                @include('components.cards.card-keuntungan')
                {{-- todo card kerugian --}}
                @include('components.cards.card-kerugian')
            </div>
            {{-- todo card pengguna baru --}}
            <div class="w-full">
                @include('components.cards.cars-listnewuser')
            </div>
        </div>

        {{-- todo card table developer dan pengguna --}}
        <div class="_component3 p-[20px] gap-[10px] grid grid-cols-1 w-full">
            {{-- todo table customer --}}
            <div class="_table1">
                @include('components.tables.table-customer')
            </div>
        </div>
    </div>
@endsection
