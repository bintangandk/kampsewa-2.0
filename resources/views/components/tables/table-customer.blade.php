<div class="_wrapper-table w-full p-5 bg-white rounded-[20px]">
    <div class="_heading mb-4 text-[20px] font-medium capitalize">
        <h1>Daftar Pengguna Online</h1>
        <p>Tota user online : {{ $customer_online->count() == 0 ? 0 : $customer_online->count() }} User.</p>
    </div>
    <!-- component -->
    <div class="overflow-x-auto rounded-lg h-[500px] overflow-y-auto">
        @if (count($customer_online) == 0)
            <div class="w-full h-full flex justify-center items-center">
                <img class="w-[300px] h-auto object-cover" src="{{ asset('images/illustration/222社交206气泡水肌理矢量创意插画气泡水-01 1.png') }}" alt="">
                <div>
                    <p class="text-[40px] font-bold">OOPS!</p>
                    <p class="text-[16px]">Tidak User Online Saat ini</p>
                </div>
            </div>
        @else
            <table class="w-full border-collapse table-auto bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">No</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nama</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Waktu Aktif</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @foreach ($customer_online as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="relative h-10 w-10">
                                    <img class="h-full w-full rounded-full object-cover object-center"
                                        src="{{ asset('assets/image/customers/profile/' . $item->foto) }}"
                                        alt="" />
                                    <span
                                        class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">{{ $item->name }}</div>
                                    <div class="text-gray-400">{{ $item->email }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">Customer</td>
                            <td class="px-6 py-4">
                                @if($item->time_login)
                                {{ \Carbon\Carbon::parse($item->time_login)->diffForHumans() }}
                            @endif
                            </td>
                            <td><a href="{{ route('detail-pengguna.index', [$item->name]) }}" class="px-4 py-2"><i class="bi bi-pen-fill"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
