<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengeluaran Developer</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .title {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .sub-head {
            font-size: 12px;
            font-weight: normal;
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
            color: #555;
        }

        .heading {
            width: 100%;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border: 1px solid #ddd;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }

        tr,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        th[colspan="2"] {
            text-align: center;
        }

        .sumber {
            text-transform: capitalize;
        }

        .month-total {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .grand-total {
            font-weight: bold;
            font-size: 14px;
            margin-top: 15px;
            padding: 8px;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }

        .signature {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="heading">
        <h2>Laporan Pengeluaran Developer</h2>
        <p class="sub-head">Periode: {{ date('F Y', strtotime($startDate)) }} - {{ date('F Y', strtotime($endDate)) }}
        </p>
    </div>

    <div class="title">
        <p>Developer: <b>{{ $developer->name }}</b></p>
        <p>Email: <b>{{ $developer->email }}</b></p>
    </div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Bulan/Tahun</th>
                    <th>Tanggal</th>
                    <th>Sumber Pengeluaran</th>
                    <th>Deskripsi</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotal = 0;
                @endphp

                @foreach ($pengeluaranGrouped as $monthYear => $pengeluaranBulan)
                    @php
                        $monthTotal = $pengeluaranBulan->sum('nominal');
                        $grandTotal += $monthTotal;
                    @endphp

                    <tr class="month-total">
                        <td colspan="4">{{ $monthYear }}</td>
                        <td>Rp. {{ number_format($monthTotal) }}</td>
                    </tr>

                    @foreach ($pengeluaranBulan as $pengeluaran)
                        <tr>
                            <td></td>
                            <td>{{ $pengeluaran->created_at->format('d/m/Y') }}</td>
                            <td class="sumber">{{ $pengeluaran->sumber }}</td>
                            <td>{{ $pengeluaran->deskripsi }}</td>
                            <td>Rp. {{ number_format($pengeluaran->nominal) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="grand-total">
            Total Keseluruhan: Rp. {{ number_format($grandTotal) }}
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
        <div class="signature">
            <p>Mengetahui,</p>
            <br><br><br>
            <p>_________________________</p>
            <p>{{ $developer->name }}</p>
            <p>Developer</p>
        </div>
    </div>
</body>

</html>
