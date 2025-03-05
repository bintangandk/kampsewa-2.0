<div class="_card-profile shadow-box-shadow-46 bg-white w-full rounded-[20px] relative overflow-clip">

    {{-- todo background and status level --}}
    <div class="_background-level top-0">
        <div
            class="_level absolute p-2 bg-white/40 backdrop-blur-sm rounded-full font-bold top-4 left-4 w-fit text-[12px]">
            Customer</div>
        <img class="w-full h-[200px] object-cover"
            src="{{ asset('assets/image/customers/background/pexels-juan-mendez-1082316.jpg') }}" alt="">
    </div>

    {{-- todo photo profile --}}
    <div class="_photo-btnedit pt-2 px-4 w-full flex items-start justify-between">
        <div class="_photo w-[100px] mt-[-60px] h-[100px] border-4 border-white rounded-full overflow-clip"><img
                class="w-full object-cover" src="{{ asset('assets/image/customers/profile/' . $data->foto) }}" alt=""></div>
        {{-- <div class="_btn-edit"><button class="px-4 py-2 gradient-1 text-[12px] font-bold cursor-pointer text-white rounded-full">Edit profile</button></div> --}}
    </div>

    {{-- todo data name to gender --}}
    <div class="_name-sampai-gender px-4 py-2">
        <div class="_name font-bold text-[#19191b]">{{ $name }}</div>
        <div class="_id text-[12px] text-gray-400 font-medium mt-[-5px] line-clamp-1">ID: {{ $data->user_id }}</div>
        <div class="_alamat text-[12px] w-full font-medium mt-2">{{ $data->alamat ? json_decode($data->alamat)->alamat_1 : 'Belum di isi.' }}</div>
        <div class="_join-birth mt-2">
            <div class="_join flex items-center gap-1">
                <div class="text-[12px] mt-[2px] font-medium text-[#19191b]"><i class="fi fi-rr-calendar"></i>
                </div>
                <div class="text-[12px] font-medium text-[#19191b]">Bergabung {{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
            </div>
            <div class="_join flex items-center gap-1">
                <div class="text-[12px] mt-[2px] font-medium text-[#19191b]"><i class="fi fi-rr-party-horn"></i>
                </div>
                <div class="text-[12px] font-medium text-[#19191b]">Lahir {{ Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</div>
            </div>
        </div>
        <div class="_phone-gender gap-1 mt-3 w-full grid grid-cols-2">
            <div class="_phone p-2 bg-[#BAF3D2] rounded-[20px]">
                <div class="_icon text-[20px]"><i class="fi fi-rr-mobile-notch"></i></div>
                <div class="_number">
                    <p class="text-[14px] font-bold">Nomor Telepon</p>
                    <p class="text-[12px] font-medium">{{ $data->nomor_telephone }}</p>
                </div>
            </div>
            <div class="_gender bg-[#FEE4CB] rounded-[20px] p-2">
                <div class="_icon text-[20px]"><i class="fi fi-rr-venus-mars"></i></div>
                <div class="_gend">
                    <p class="text-[14px] font-bold">Jenis Kelamin</p>
                    <p class="text-[12px] font-medium">{{ $data->jenis_kelamin }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
