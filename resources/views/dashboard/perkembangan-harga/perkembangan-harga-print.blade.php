<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perkembangan Harga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            font-size: 12px;
            text-align: right;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <h2>LAPORAN PERKEMBANGAN HARGA KOMODITAS</h2>
    <div class="subtitle">Dinas Perdagangan - Bapokting</div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">#</th>
                    <th>Nama Komoditas</th>
                    <th>Jenis Komoditas</th>
                    <th>Nama Pasar</th>
                    <th>UPTD</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perkembanganHargas as $k => $perkembanganHarga)
                    @foreach ($perkembanganHarga['harga_monitorings'] as $i => $monitoring)
                        <tr>
                            <td class="text-center">{{ $k + 1 . '.' . ($i + 1) }}</td>
                            <td>{{ $perkembanganHarga['komoditas'] }}</td>
                            <td>{{ $monitoring->jenis_komoditas->nama_jenis }}</td>
                            <td>{{ $monitoring->pasar->nama }}</td>
                            <td>{{ $monitoring->pasar->uptd->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($monitoring->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                            </td>
                            <td>{{ 'Rp ' . number_format($monitoring->harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM YYYY HH:mm') }}
    </div>

</body>

</html>
