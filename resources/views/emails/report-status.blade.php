<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Status Laporan</title>
</head>

<body>
    <h2>Informasi Status Laporan</h2>

    @if ($status == 'terima')
        @if ($receiverRole == 'pelapor')
            <p>Halo, laporan yang Anda buat, pada id transaksi {{ $report->id_penyewaan }} telah
                <strong>DITERIMA</strong>.
            </p>
        @else
            @if ($report->terlapor->SP == 3)
                {{-- kasih pesannya kalau akun sudah terblokir dan tidak bisa membuka toko lagi --}}
                <p>Halo, Anda telah <strong>DILAPORKAN</strong> pada id transaksi {{ $report->id_penyewaan }} dan
                    laporan
                    tersebut telah <strong>DITERIMA</strong>.</p>
                <p>Akun Anda telah terblokir dan tidak bisa membuka toko lagi.</p>
                <p>
                <p><strong>Deskripsi:</strong> {{ $report->deskripsi }}</p>
                </p>
            @else
                <p>Halo, Anda telah <strong>DILAPORKAN</strong> pada id transaksi {{ $report->id_penyewaan }} dan
                    laporan
                    tersebut telah <strong>DITERIMA</strong>.</p>
                <p>Anda mendapatkan satu poin SP baru. Harap lebih berhati-hati.</p>
                <p>
                <p><strong>Deskripsi:</strong> {{ $report->deskripsi }}</p>
                </p>
            @endif

        @endif
    @else
        @if ($receiverRole == 'pelapor')
            <p>Halo, laporan yang Anda buat telah <strong>DITOLAK</strong>.</p>

            <p>Silakan periksa kembali laporan Anda.</p>
        @endif
    @endif

    <hr>

</body>

</html>
