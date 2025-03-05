@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container px-10 py-5 w-full h-auto flex justify-center">
        <div class="--wrapper-form w-[500px] h-auto bg-white shadow-box-shadow-11 p-4">
            <form id="simpan-pembayaran" action="{{ route('simpan-pembayaran-iklan.simpan', ['id_user' => Crypt::encrypt(session('id_user'))]) }}" method="POST" class="flex flex-col gap-6">
                @csrf
                <div class="--header flex flex-col gap-6">
                    <div class="--icon-title flex items-center gap-4">
                        <div class="--title">
                            <p class="text-[24px] font-black">Final Registrasi & Pembayaran</p>
                            <p>Pada tahap ini anda harus mengisi data-data yang dibutuhkan dan melakukan pembayaran melalui
                                transfer pada bank yang telah disediakan.</p>
                        </div>
                    </div>
                </div>
                <div class="--body w-full flex flex-col gap-4">
                        <input type="hidden" name="id_iklan" value="{{ $id_iklan }}">
                        <input type="hidden" name="id_user" value="{{ $id_user }}">
                        <input type="hidden" name="tanggal_mulai" value="{{ $tanggal_mulai }}">
                        <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
                        <input type="hidden" name="harga_iklan" value="{{ $harga_iklan }}">
                        <div class="--input-detail-iklan flex flex-col gap-4">
                            <div class="--input-tanggal-mulai">
                                <p class="text-[16px] font-bold">Tanggal Iklan Dimulai</p>
                                <p class="text-[14px] font-medium p-2 w-fit bg-[#0060AF] text-white">{{ Carbon\Carbon::parse($tanggal_mulai)->format('j F Y') }}</p>
                            </div>
                            <div class="--input-tanggal-akhir">
                                <p class="text-[16px] font-bold">Tanggal Iklan Berakhir</p>
                                <p class="text-[14px] font-medium w-fit p-2 bg-[#FF7300] text-white">{{ Carbon\Carbon::parse($tanggal_akhir)->format('j F Y') }}</p>
                            </div>
                            <div class="--input-harga-iklan">
                                <p class="text-[16px] font-bold">Harga Iklan</p>
                                <p class="text-[24px] font-black">Rp. {{ number_format($harga_iklan) }}</p>
                            </div>
                        </div>
                        <div class="--input-pembayaran-iklan">
                            <p class="text-[16px] font-bold">Metode Pembayaran</p>
                            <p class="text-[24px] font-black">Transfer</p>
                        </div>
                </div>
                <div class="--footer flex gap-2 items-center">
                    <button class="shadow-box-shadow-11 text-[14px] py-2 px-4">Batalkan Transaksi</button>
                    <button id="pay-button" class="bg-red-600 text-white text-[14px] py-2 px-4">Bayar Iklan</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
        <script type="text/javascript">
          document.getElementById('pay-button').onclick = function(event){
            event.preventDefault();
            // SnapToken acquired from previous step
            snap.pay('{{ $snap_token }}', {
              // Optional
              onSuccess: function(result){
                console.log('payment success', result);
                document.getElementById('simpan-pembayaran').submit();
              },
              // Optional
              onPending: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
              },
              // Optional
              onError: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
              }
            });
          };
        </script>
@endsection
