<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Antrian</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
        .footer-text {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body onload="window.print();">
    <div class="container text-center mt-5">
        <h1>Antrian Satpas 0904  <img src="/img/logo.svg" width="40" alt=""></h1>
        <h1>{{ $no_antrian }}</h1>
        <div class="footer-text">
            <p>Waktu Cetak: {{ date('d M Y H:i:s') }}</p> <!-- Menampilkan waktu cetak -->
            <p>Terima Kasih</p>
        </div>
    </div>
</body>
</html>
