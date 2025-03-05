@extends('layouts.customers.layouts-customer')
@section('customer-content')
    <div class="--container w-full px-6 py-4 h-auto sm:px-6 sm:py-4 flex justify-center">
        <div class="--table w-full flex flex-col gap-6">
            <div class="--action">
                <div class="--filter">
                    <form method="GET" id="form-filter-kelola-iklan">
                        @csrf
                        <div class="w-fit relative">
                            <select class="shadow-box-shadow-11 cursor-pointer rounded-lg bg-white appearance-none px-6 py-2"
                                name="filter_kelola_iklan" id="filter-kelola-iklan">
                                <option value="semua">Semua</option>
                                <option value="selesai">Selesai</option>
                                <option value="aktif">Aktif</option>
                                <option value="pending">Pending</option>
                            </select>
                            <i class="absolute right-2 top-1/2 transform -translate-y-1/2 bi bi-caret-down-fill"></i>
                        </div>
                    </form>
                </div>
            </div>
            <div class="--table-content w-full">
                <div class="w-full">
                    <div class="w-full h-[700px] overflow-scroll px-0">
                        <table class="w-full bg-white min-w-max table-auto text-left">
                            <thead class="w-full">
                                <tr>
                                    <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                        <p
                                            class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                            Heading</p>
                                    </th>
                                    <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                        <p
                                            class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                            Harga</p>
                                    </th>
                                    <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                        <p
                                            class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                            Waktu</p>
                                    </th>
                                    <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                        <p
                                            class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                            Status</p>
                                    </th>
                                    <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                                        <p
                                            class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70">
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_iklan as $item)
                                    <tr>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ asset('assets/image/customers/advert/'. $item->poster)}}"
                                                    alt="Spotify"
                                                    class="inline-block relative object-center w-12 h-12 rounded-lg border border-blue-gray-50 bg-blue-gray-50/50 object-contain p-1">
                                                <div>
                                                    <p
                                                        class="truncate max-w-xs block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">
                                                        {{ $item->judul }}</p>
                                                    <div class="truncate max-w-md">
                                                        <span class="text-sm font-normal">{{ $item->sub_judul }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <p
                                                class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                                Rp. {{ number_format($item->harga_iklan, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <p
                                                class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                                {{ $item->durasi_hari }} Hari</p>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <div class="w-max">
                                                <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none {{ $item->status_iklan == 'Selesai' ? 'bg-red-500/20 text-red-900' : '' }} {{ $item->status_iklan == 'Pending'
                                                    ? '
                                                                                                    bg-amber-500/20 text-amber-900
                                                                                                '
                                                    : '' }} {{ $item->status_iklan == 'Aktif' ? 'bg-green-500/20 text-green-900' : '' }} py-1 px-2 text-xs rounded-md"
                                                    style="opacity: 1;">
                                                    <span class="">{{ $item->status_iklan }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <button onclick="window.location.href='{{ route('kelola-iklan.update-iklan-view', ['id_iklan' => Crypt::encrypt($item->id_iklan)]) }}'"
                                                class="relative {{ $item->status_iklan == 'Aktif' ? '' : 'hidden' }} align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                                                type="button">
                                                <span
                                                    class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" aria-hidden="true" class="h-4 w-4">
                                                        <path
                                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </button>
                                            <button
                                            id="btn-form-delete-kelola-iklan-{{ $item->id_iklan}}"
                                                class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                                                type="button">
                                                <span
                                                    class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" aria-hidden="true" class="h-4 w-4">
                                                        <path
                                                            d="M9 3a1 1 0 011-1h4a1 1 0 011 1v1h5a1 1 0 110 2h-1v13a3 3 0 01-3 3H8a3 3 0 01-3-3V6H4a1 1 0 110-2h5V3zM8 6v13a1 1 0 001 1h6a1 1 0 001-1V6H8zM10 9a1 1 0 012 0v7a1 1 0 11-2 0V9zm4 0a1 1 0 012 0v7a1 1 0 11-2 0V9z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </td>
                                        <form id="form-delete-kelola-iklan-{{ $item->id_iklan }}" action="{{ route('kelola-iklan.delete', ['id_iklan' => $item->id_iklan]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var filter = "{{ request()->input('filter_kelola_iklan') }}";

            // Set the selected filter option in the dropdown select
            if (filter) {
                document.getElementById('filter-kelola-iklan').value = filter;
            }

            // Add change event listener to the dropdown select
            document.getElementById('filter-kelola-iklan').addEventListener('change', function() {
                // Submit the form
                document.getElementById('form-filter-kelola-iklan').submit();
            });
        });

        document.querySelectorAll('[id^="btn-form-delete-kelola-iklan-"]').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Data ini tidak akan kembali ketika dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus ini!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const penghasilanId = this.id.replace('btn-form-delete-kelola-iklan-', '');
                        document.getElementById('form-delete-kelola-iklan-' + penghasilanId).submit();
                    } else {
                        Swal.fire('Dibatalkan', 'Penghapusan dibatalkan', 'info');
                    }
                });
            });
        });
    </script>
@endsection
