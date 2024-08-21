<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Antrian Pemohon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .styled-table {
            width: 100%;
            border-collapse: collapse;
        }
        .styled-table th,
        .styled-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .styled-table th {
            background-color: #f2f2f2;
        }
        .title {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1 class="title">Laporan Antrian Pemohon</h1>
    <h2 class="title">Bulan: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Pemohon Baru</th>
                <th>Pemohon Perpanjangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $jumlahBaru }} orang</td>
                <td>{{ $jumlahPerpanjangan }} orang</td>
            </tr>
        </tbody>
    </table>
    <button onClick="window.print()">Cetak</button>
</body>
</html>
