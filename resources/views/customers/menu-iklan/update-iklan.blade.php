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
        <form enctype="multipart/form-data" class="form" method="POST" action="{{ route('kelola-iklan.update-iklan-post', ['id_iklan' => $data->id, 'id_user' => Crypt::encrypt(session('id_user'))]) }}">
            @csrf
            @method('PUT')
            <p class="title">Update Data Iklan</p>
            <p class="message">Update data iklan yang mungkin kurang cocok!</p>
            <label for="file" class="labelFileGambar">
                <span id="iconUpload" style="display: none;">
                    <svg xml:space="preserve" viewBox="0 0 184.69 184.69" xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns="http://www.w3.org/2000/svg" id="Capa_1" version="1.1" width="60px" height="60px">
                        <g>
                            <g>
                                <g>
                                    <path d="M149.968,50.186c-8.017-14.308-23.796-22.515-40.717-19.813
                                        C102.609,16.43,88.713,7.576,73.087,7.576c-22.117,0-40.112,17.994-40.112,40.115c0,0.913,0.036,1.854,0.118,2.834
                                        C14.004,54.875,0,72.11,0,91.959c0,23.456,19.082,42.535,42.538,42.535h33.623v-7.025H42.538
                                        c-19.583,0-35.509-15.929-35.509-35.509c0-17.526,13.084-32.621,30.442-35.105c0.931-0.132,1.768-0.633,2.326-1.392
                                        c0.555-0.755,0.795-1.704,0.644-2.63c-0.297-1.904-0.447-3.582-0.447-5.139c0-18.249,14.852-33.094,33.094-33.094
                                        c13.703,0,25.789,8.26,30.803,21.04c0.63,1.621,2.351,2.534,4.058,2.14c15.425-3.568,29.919,3.883,36.604,17.168
                                        c0.508,1.027,1.503,1.736,2.641,1.897c17.368,2.473,30.481,17.569,30.481,35.112c0,19.58-15.937,35.509-35.52,35.509H97.391
                                        v7.025h44.761c23.459,0,42.538-19.079,42.538-42.535C184.69,71.545,169.884,53.901,149.968,50.186z"
                                        style="fill:#010002;"></path>
                                </g>
                                <g>
                                    <path d="M108.586,90.201c1.406-1.403,1.406-3.672,0-5.075L88.541,65.078
                                        c-0.701-0.698-1.614-1.045-2.534-1.045l-0.064,0.011c-0.018,0-0.036-0.011-0.054-0.011c-0.931,0-1.85,0.361-2.534,1.045
                                        L63.31,85.127c-1.403,1.403-1.403,3.672,0,5.075c1.403,1.406,3.672,1.406,5.075,0L82.296,76.29v97.227
                                        c0,1.99,1.603,3.597,3.593,3.597c1.979,0,3.59-1.607,3.59-3.597V76.165l14.033,14.036
                                        C104.91,91.608,107.183,91.608,108.586,90.201z" style="fill:#010002;"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <img id="previewImage" src="{{ asset('assets/image/customers/advert/' . $data->poster) }}" alt="Preview"
                    style="max-width: 100px; max-height: 100px;" />
                <p id="uploadText" style="display: none;">Drag and drop your file here or click to select a file!</p>
            </label>
            <input class="inputGambar" name="poster" id="file" type="file" style="display: none;" />

            <label>
                <input name="judul" value="{{ $data->judul }}" required="" placeholder="" type="text" class="input">
                <span>Judul</span>
                @error('judul')
                    <p class="text-red-500 font-medium text-[14px]">{{ $message }}</p>
                @enderror
            </label>
            <label>
                <input name="sub_judul" value="{{ $data->sub_judul }}" required="" placeholder="" type="text" class="input">
                <span>Sub Judul</span>
                @error('sub_judul')
                    <p class="text-red-500 font-medium text-[14px]">{{ $message }}</p>
                @enderror
            </label>
            <label>
                <input name="deskripsi" value="{{ $data->deskripsi }}" required="" placeholder="" type="text" class="input">
                <span>Deskripsi</span>
                @error('deskripsi')
                    <p class="text-red-500 font-medium text-[14px]">{{ $message }}</p>
                @enderror
            </label>
            <button type="submit" class="submit">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('previewImage');
                    const iconUpload = document.getElementById('iconUpload');
                    const uploadText = document.getElementById('uploadText');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    iconUpload.style.display = 'none';
                    uploadText.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });

        // Initial state
        const previewImage = document.getElementById('previewImage');
        const iconUpload = document.getElementById('iconUpload');
        const uploadText = document.getElementById('uploadText');

        if (previewImage.src === "" || previewImage.src.endsWith("/")) {
            previewImage.style.display = 'none';
            iconUpload.style.display = 'block';
            uploadText.style.display = 'block';
        }
    </script>
</body>
</html>
