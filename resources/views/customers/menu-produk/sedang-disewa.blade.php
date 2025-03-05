@extends('customers.menu-dashboard-cust.dashboard')
@section('customer-content')
    <div class="--container px-10 py-5 flex flex-col gap-8">
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
            <ul class="flex items-center gap-2">
                <li><a class="{{ $title == 'Produk Menu | KampSewa' ? 'bg-[#F8F7F4] font-medium' : '' }} hover:font-medium hover:bg-[#F8F7F4] hover:text-[#0F172A] text-[14px] px-4 py-2 rounded-full"
                        href="{{ route('menu-produk.index', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Semua Produk</a></li>
                <li><a class="text-[14px] hover:font-medium px-4 py-2 rounded-full hover:bg-[#F8F7F4] hover:text-[#0F172A]"
                        href="{{ route('menu-produk.kelola-produk', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Kelola Produk</a></li>
                <li><a class="{{ $title == 'Sedang Disewa | KampSewa' ? 'bg-[#F8F7F4] font-medium' : '' }} text-[14px] hover:font-medium px-4 py-2 rounded-full hover:bg-[#F8F7F4] hover:text-[#0F172A]"
                        href="{{ route('menu-produk.sedang-disewa', ['id_user' => Crypt::encrypt(session('id_user'))]) }}">Sedang Disewa</a></li>
            </ul>
        </div>


    </div>
@endsection
