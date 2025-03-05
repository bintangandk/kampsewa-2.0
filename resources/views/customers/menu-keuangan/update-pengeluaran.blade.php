<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/universeio/form-1.css') }}">
    <link href="{{ asset('template/azia/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/azia/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/azia/lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/azia/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/azia/css/azia.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scrollbar/scrollbar-sidebar.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('components.navbars.navbar2')
    <div class="--container w-full flex justify-center mt-4">
        <form class="form" method="POST"
            action="{{ route('keuangan.update-pengeluaran-post-customer', ['id_pengeluaran' => $data_update->id, 'id_user' => Crypt::encrypt(session('id_user'))]) }}">
            @csrf
            @method('PUT')
            <p class="title">Update Data</p>
            <p class="message">Update data pengeluaran yang mungkin kurang cocok!</p>
            <label>
                <input name="sumber" value="{{ $data_update->sumber }}" required="" placeholder="" type="text"
                    class="input">
                <span>Sumber</span>
                @error('sumber')
                    <p class="text-red-500 font-medium text-[14px]">{{ $message }}</p>
                @enderror
            </label>
            <label>
                <input name="deskripsi" value="{{ $data_update->deskripsi }}" required="" placeholder=""
                    type="text" class="input">
                <span>Deskripsi</span>
                @error('deskripsi')
                    <p class="text-red-500 font-medium text-[14px]">{{ $message }}</p>
                @enderror
            </label>
            <label>
                <input name="nominal" value="{{ $data_update->nominal }}" required="" placeholder="" type="number"
                    class="input">
                <span>Nominal</span>
                @error('nominal')
                    <p class="text-red-500 font-medium text-[14px]">{{ $message }}</p>
                @enderror
            </label>
            <button type="submit" class="submit">Submit</button>
        </form>
    </div>
</body>

</html>
