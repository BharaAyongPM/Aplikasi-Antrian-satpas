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
    <h2 class="title">Bulan: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</h2>
    <a class="navbar-brand text-primary bg-white p-2 rounded-3" href="#">
        <img src="{{ asset('/img/logo.svg') }}" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
        SATPAS POLRESTA TANJUNG PINANG 0904<br>
      </a><br>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Loket Pendaftaran</th>
                <th>Loket Ujian</th>
                <th>Loket Validasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($jumlahPerLoket as $jumlah)
                    <td>{{ $jumlah }} orang</td>
                @endforeach
            </tr>
        </tbody>
    </table>
    <button onClick="window.print()">Cetak</button>
</body>
</html>
