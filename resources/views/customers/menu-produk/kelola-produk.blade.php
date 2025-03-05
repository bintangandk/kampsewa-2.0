@extends('customers.menu-dashboard-cust.dashboard')
@section('customer-content')
    <div class="--container px-10 mobile-max:py-2 mobile-max:px-5 py-5 flex flex-col gap-8">
        <div class="--wrapper-heading-wrapper-deskripsi-halaman">
            <h1 class="text-[24px] font-bold capitalize">Manajemen Produk Anda!</h1>
            <p class="text-[14px]">Halaman ini berisi data produk anda, anda bisa menambah, mengedit dan menghapus produk,
                melihat produk yang
                sedang disewa, menampilkan berdasarkan produk terlaris disewa, harga sewa termurah - termahal, produk
                terbaru
                dan terlama sekaligus bisa mencari berdasarkan kosakata nama produk dan harga. Jika anda masih bingung lihat
                menu cara penggunaan fitur pada menu <a href=""
                    class="text-blue-700 underline hover:underline font-bold">Dokumentasi</a>.</p>
        </div>

        {{-- wrapper navigation item menu --}}
        <div class="--wrapper-navigation-menu w-full">
            <ul class="flex items-center gap-2 mobile-max:gap-4 mobile-max:flex-wrap">
                <li><a class="{{ $title == 'Produk Menu | KampSewa' ? 'bg-[#F8F7F4] font-medium' : '' }} hover:font-medium hover:bg-[#F8F7F4] hover:text-[#0F172A] text-[14px] px-4 py-2 rounded-full"
                        href="{{ route('menu-produk.index', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Semua
                        Produk</a></li>
                <li><a class="{{ $title == 'Kelola Produk | KampSewa' ? 'bg-[#F8F7F4] font-medium' : '' }} text-[14px] hover:font-medium px-4 py-2 rounded-full hover:bg-[#F8F7F4] hover:text-[#0F172A]"
                        href="{{ route('menu-produk.kelola-produk', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Kelola
                        Produk</a></li>
                <li><a class="text-[14px] hover:font-medium px-4 py-2 rounded-full hover:bg-[#F8F7F4] hover:text-[#0F172A]"
                        href="{{ route('menu-produk.sedang-disewa', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Sedang
                        Disewa</a></li>
            </ul>
        </div>

        <div class="--wrapper-action-button">
            {{-- todo wrapper total search filter --}}
            <div class="flex w-full justify-between items-center mobile-max:flex-col-reverse gap-6 mb-4">

                {{-- todo total users --}}
                <div class="_total">
                    <p class="text-[#19191b] text-[14px] font-bold whitespace-nowrap">{{ $total_produk }} Produk</p>
                </div>

                {{-- todo wrapper search filter --}}
                <div class="_search-filter w-1/2 mobile-max:w-full items-center mobile-max:flex-col small-desktop:w-full flex gap-[20px]">
                    {{-- todo search --}}
                    <div class="_searrh w-full">
                        <form method="GET" class="w-full">
                            <div class="relative w-full mx-auto">
                                <input name="search" value="{{ $search }}"
                                    class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    type="search" placeholder="Berdasarkan Nama dan Stok...">
                                <button class="absolute right-0 rounded-md text-white py-2 px-4 bg-blue-700"
                                    type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    {{-- todo untuk tombol tambah data --}}
                    <div class="_btn-tambah-data whitespace-nowrap mobile-max:w-full">
                        <a
                            href="{{ route('menu-produk.tambah-produk', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">
                            <button class="mobile-max:w-full px-4 py-2 gradient-1 cursor-pointer text-white rounded-full">
                                <div class="_icon-plus"></div>
                                <span>Tambah Produk</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="--table w-full h-auto flex flex-col gap-6">
            <div
                class="relative w-full h-[500px] overflow-y-hidden overflow-x-scroll shadow-box-shadow-11 rounded-[20px] bg-white">
                <div class="w-full h-full overflow-x-auto">
                    @if ($produk->count() == 0)
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="flex items-center gap-4 justify-center">
                                <img class="w-[300px] h-auto object-cover"
                                    src="{{ asset('images/illustration/filling-survey.png') }}" alt="">
                                <div>
                                    <p class="text-[40px] font-black">OOPS!</p>
                                    <p class="text-[16px] font-medium">Sepertinya {{ $search }} Tidak ada dalam daftar
                                        produk!
                                </div>
                            </div>
                        </div>
                    @else
                        <table class="w-full min-w-max text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="sticky top-0 z-10 text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Poduk
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status Produk
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total Stok
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 flex items-center gap-2 dark:text-white">
                                            @if ($item->foto != null)
                                                <img class="w-[50px] h-[50px] rounded-[10px] object-cover"
                                                    src="{{ asset('assets/image/customers/produk/' . $item->foto) }}"
                                                    alt="">
                                            @else
                                                <img class="w-[50px] h-[50px] rounded-[10px] object-cover"
                                                    src="{{ asset('assets/image/customers/produk/foldingcamptableleadpic.jpg') }}"
                                                    alt="">
                                            @endif
                                            <p class="line-clamp-2 capitalize">{{ $item->nama_produk }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-left">
                                            <p class="py-2 px-4 w-fit bg-[#F0FDF4] text-[#4ED17E] rounded-full">
                                                {{ $item->status_produk }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->stok_produk }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-2 items-center">
                                            <p><a
                                                    href="{{ route('menu-produk.update-produk', ['id_produk' => Crypt::encrypt($item->id_produk), 'id_user' => Crypt::encrypt($item->id_user)]) }}"><i
                                                        class="text-[16px] bi bi-pen-fill"></i></a>
                                            <form id="delete-produk-{{ $item->id_produk }}"
                                                action="{{ route('menu-produk.delete', ['id_produk' => $item->id_produk]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button id="delete-product-{{ $item->id_produk }}" type="button">
                                                    <i class="text-[16px] bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                            </p>
                                            {{-- <p><a href="{{ route('menu-produk.detail_produk', ['nama_produk' =>$item->nama_produk, 'id_user' => Crypt::encrypt(session('id_user'))]) }}"><i
                                                            class="text-[16px] bi bi-file-earmark-spreadsheet-fill"></i></a>
                                                </p> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            {{ $produk->onEachSide(1)->links('components.paginate.custom-pagination') }}
        </div>
    </div>
    <script>
        document.querySelectorAll('[id^="delete-product-"]').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah sudah yakin?',
                    text: "Anda akan menghapus produk ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const productId = this.id.replace('delete-product-', '');
                        document.getElementById('delete-produk-' + productId).submit();
                    } else {
                        Swal.fire('Cancelled', 'Penghapusan dibatalkan', 'info');
                    }
                });
            });
        });
    </script>
@endsection
