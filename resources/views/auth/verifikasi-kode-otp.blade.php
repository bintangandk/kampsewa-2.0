<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="_container w-full h-screen flex justify-center items-center mobile-max:p-4 mobile-max:h-auto">
        <div class="_form w-[400px]">
            <form action="{{ route('lupa-password.check-otp', ['nomor_telephone' => $nomor_telephone]) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="_image w-full flex justify-center">
                    <img class="w-[250px] object-cover" src="{{ asset('images/grapy-young-man-coding-on-laptop.png') }}"
                        alt="">
                </div>
                <div class="_title">
                    <h1 class="text-[24px] text-center font-medium">Masukkan Kode OTP</h1>
                    <p class="text-[14px] text-center">Kode OTP sudah terkirim! cek email anda dan masukkan kode OTP untuk merubah password.</p>
                </div>
                <div class="_feild-email flex flex-col gap-2">
                    <label for="email" class="text-[14px] font-medium">Masukkan Kode OTP:</label>
                    <div class="_email w-full inputs flex gap-2 items-center" id="inputs">
                        <input name="otp1" class="input h-[50px] rounded-[10px] w-full bg-gray-100 text-center text-[16px] font-bold" type="text" inputmode="numeric" maxlength="1" />
                        <input name="otp2" class="input h-[50px] rounded-[10px] w-full bg-gray-100 text-center text-[16px] font-bold" type="text" inputmode="numeric" maxlength="1" />
                        <input name="otp3" class="input h-[50px] rounded-[10px] w-full bg-gray-100 text-center text-[16px] font-bold" type="text" inputmode="numeric" maxlength="1" />
                        <input name="otp4" class="input h-[50px] rounded-[10px] w-full bg-gray-100 text-center text-[16px] font-bold" type="text" inputmode="numeric" maxlength="1" />
                        <input name="otp5" class="input h-[50px] rounded-[10px] w-full bg-gray-100 text-center text-[16px] font-bold" type="text" inputmode="numeric" maxlength="1" />
                        <input name="otp6" class="input h-[50px] rounded-[10px] w-full bg-gray-100 text-center text-[16px] font-bold" type="text" inputmode="numeric" maxlength="1" />
                    </div>
                </div>
                <div class="_button-submit w-full">
                    <button type="submit"
                        class="w-full p-4 bg-gradient-to-bl rounded-[10px] from-[#B381F4] to-[#5038ED] text-white text-[14px] font-medium">Selanjutnya</button>
                </div>
            </form>
            <div class="w-full flex gap-2 items-center mt-2 mobile-max:flex-col">
                <form action="{{ route('lupa-password.kirim-ulang', ['nomor_telephone' => $nomor_telephone]) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[14px] font-medium bg-none text-green-500 underline">Kirim Ulang OTP</button>
                </form>
                <div class="w-[3px] h-[15px] bg-gray-200 rounded-full"></div>
                <p class="text-[14px] font-medium text-center">Kembali Halaman Login <a href="{{ route('login') }}"
                    class="text-[#5038ED] hover:underline">tekan disini!</a></p>
            </div>
        </div>
    </div>
    <script>
        // script.js
        const inputs = document.getElementById("inputs");

        inputs.addEventListener("input", function(e) {
            const target = e.target;
            const val = target.value;

            if (isNaN(val)) {
                target.value = "";
                return;
            }

            if (val != "") {
                const next = target.nextElementSibling;
                if (next) {
                    next.focus();
                }
            }
        });

        inputs.addEventListener("keyup", function(e) {
            const target = e.target;
            const key = e.key.toLowerCase();

            if (key == "backspace" || key == "delete") {
                target.value = "";
                const prev = target.previousElementSibling;
                if (prev) {
                    prev.focus();
                }
                return;
            }
        });
    </script>

    @include('sweetalert::alert')
</body>
</html>
