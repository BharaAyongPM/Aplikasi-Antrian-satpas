<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <title>Sistem Aplikasi Antrian Satpas</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
      </svg>
</head>
<body>

@if(session('success'))
<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
        {{ session('success') }}
    </div>

  </div>
        @endif
<main class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="/img/logo.svg" width="40" alt="">
            <span class="fs-4">Sistem Antrian Satpas Kota Tanjung Pinang</span>
        </a>
    </header>

    <div class="row align-items-md-stretch mb-2">
        <div class="col-md-6">
            <div class="h-100 p-5 bg-success text-white rounded-3">
                <h2>Antrian Pemohon Baru</h2>
                <p>Klik tombol di bawah untuk mencetak antrian.</p>
                <button onclick="printAntrian('{{ route('antrian.cetak', ['jenis' => 'baru', 'id' => 1]) }}')" class="btn btn-outline-light btn-lg">Pemohon Baru</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-primary text-white rounded-3">
                <h2>Antrian Pemohon Perpanjangan</h2>
                <p>Klik tombol di bawah untuk mencetak antrian.</p>
                <button onclick="printAntrian('{{ route('antrian.cetak', ['jenis' => 'perpanjangan', 'id' => 1]) }}')" class="btn btn-outline-light btn-lg">Perpanjangan</button>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="d-flex justify-content-center mt-4">
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#surveyModal">
            Isi Survey Kepuasan
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="surveyModal" tabindex="-1" aria-labelledby="surveyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/submit-survey" method="post" id="satisfactionForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="surveyModalLabel">Puaskan Anda dengan Pelayanan Kami?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <input type="hidden" name="satisfaction_level" value="0" id="satisfactionInput">
                        <button type="button" class="btn btn-lg btn-success m-2" onclick="submitSatisfaction('3')">😃 Sangat Puas</button>
                        <button type="button" class="btn btn-lg btn-warning m-2" onclick="submitSatisfaction('2')">🙂 Puas</button>
                        <button type="button" class="btn btn-lg btn-danger m-2" onclick="submitSatisfaction('1')">😐 Kurang Puas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<iframe id="printFrame" name="printFrame" style="display: none;"></iframe>
<div class="container-fluid">
    <footer class="py-4 text-muted border-top">
        &copy; <?= date('Y'); ?> Sistem Antrian Satpas Kota Tanjung Pinang
    </footer>
</div>
<script>
function printAntrian(url) {
    var printFrame = document.getElementById('printFrame');
    printFrame.onload = function() {
        printFrame.contentWindow.print();
    };
    printFrame.src = url;
}
</script>
<script>
    function submitSatisfaction(level) {
        document.getElementById('satisfactionInput').value = level;
        document.getElementById('satisfactionForm').submit();
    }
</script>
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
