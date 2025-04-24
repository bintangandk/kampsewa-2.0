@extends('layouts.developers.ly-dashboard') 
@section('content') 
<div class="--container">
    <!-- Header Image -->
    <div class="--component-awal w-full h-auto">
        <img class="w-full object-cover h-[300px]" src="{{ asset('images/pexels-toulouse-3195757.jpg') }}" alt="">
    </div>
    
    <!-- Profile Section -->
    <div class="w-full flex justify-center px-4 mt-[-50px]">
        <div class="w-full max-w-6xl"> <!-- Anda bisa menyesuaikan max-width sesuai kebutuhan -->
            <div class="--card-detail-profile-user w-full bg-white shadow-box-shadow-11 rounded-[20px] p-6">
                <!-- Profile Content -->
                <div class="flex flex-col items-center text-center gap-4">
                    <!-- Profile Image -->
                    <div class="--image">
                        <img class="object-cover border-2 border-solid border-white outline outline-[#5038ED] w-[120px] h-[120px] rounded-full" 
                             src="{{ asset('assets/image/allysa.jpg') }}" alt="">
                    </div>
                    
                    <!-- Name and ID -->
                    <div class="--name-id">
                        <p class="text-[20px] font-bold">{{ session('nama_lengkap') }}</p>
                        <p class="text-[14px] font-medium text-gray-400">ID : user786958434657123</p>
                    </div>
                    
                    <!-- Edit Button -->
                    <div class="--button">
                        <button class="px-6 py-2 gradient-1 text-[14px] font-bold cursor-pointer text-white rounded-full">
                            Edit Profile
                        </button>
                    </div>
                    
                    <!-- Profile Details Grid -->
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                        <!-- Phone -->
                        <div class="--number-phone bg-[#F8F7F4] rounded-[20px] w-full flex gap-4 items-center p-4">
                            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center bg-white">
                                <i class="bi bi-telephone-fill text-[#5038ED]"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[12px] font-medium text-gray-400">Nomor Telepon:</p>
                                <p class="text-[14px] font-bold">081331640909</p>
                            </div>
                        </div>
                        
                        <!-- Birth Date -->
                        <div class="--tanggal-lahir bg-[#F8F7F4] rounded-[20px] w-full flex gap-4 items-center p-4">
                            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center bg-white">
                                <i class="bi bi-balloon-fill text-[#5038ED]"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[12px] font-medium text-gray-400">Lahir:</p>
                                <p class="text-[14px] font-bold">20 November 2004</p>
                            </div>
                        </div>
                        
                        <!-- Gender -->
                        <div class="--gender bg-[#F8F7F4] rounded-[20px] w-full flex gap-4 items-center p-4">
                            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center bg-white">
                                <i class="bi bi-gender-female text-[#5038ED]"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[12px] font-medium text-gray-400">Jenis Kelamin:</p>
                                <p class="text-[14px] font-bold">Perempuan</p>
                            </div>
                        </div>
                        
                        <!-- Level -->
                        <div class="--level bg-[#F8F7F4] rounded-[20px] w-full flex gap-4 items-center p-4">
                            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center bg-white">
                                <i class="bi bi-person-check text-[#5038ED]"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[12px] font-medium text-gray-400">Level:</p>
                                <p class="text-[14px] font-bold">Developer</p>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="--email bg-[#F8F7F4] rounded-[20px] w-full flex gap-4 items-center p-4">
                            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center bg-white">
                                <i class="bi bi-envelope-at-fill text-[#5038ED]"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[12px] font-medium text-gray-400">Email:</p>
                                <p class="text-[14px] font-bold">cha@gmail.com</p>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="--status bg-[#F8F7F4] rounded-[20px] w-full flex gap-4 items-center p-4">
                            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center bg-white">
                                <i class="bi bi-check2 text-[#5038ED]"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[12px] font-medium text-gray-400">Status:</p>
                                <p class="text-[14px] font-bold">Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
