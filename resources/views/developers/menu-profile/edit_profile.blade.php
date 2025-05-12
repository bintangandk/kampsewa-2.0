@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="--container py-10 px-4 flex justify-center">
        <div class="w-full max-w-4xl bg-white shadow-box-shadow-11 rounded-[20px] p-6">
            <h2 class="text-[24px] font-bold text-center mb-6">Edit Profil</h2>

            <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}

                <!-- Foto -->
                <div class="flex flex-col items-center mb-6">
                    <img class="w-[120px] h-[120px] object-cover rounded-full border-4 border-white outline outline-[#5038ED]"
                        src="{{ asset('assets/image/developers/' . auth()->user()->foto) }}" alt="Foto Profil">
                    <input type="file" name="foto" class="mt-3 text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5038ED]">
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Nomor Telepon</label>
                        <input type="text" name="nomor_telephone" value="{{ auth()->user()->nomor_telephone }}"
                            minlength="11" maxlength="14" pattern="\d+"
                            title="Masukkan nomor telepon yang terdiri dari 11 hingga 14 angka" required
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5038ED]">
                    </div>


                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ auth()->user()->tanggal_lahir }}"
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5038ED]">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5038ED]">
                            <option value="Laki-laki" {{ auth()->user()->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ auth()->user()->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-600">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5038ED]">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-center pt-4">
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 text-black rounded-full text-sm font-bold hover:bg-indigo-700 transition-colors duration-200 shadow-md">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
