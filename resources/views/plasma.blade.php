<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DAFTAR ANTRIAN SATPAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    {{-- <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
      body{
        background-image: url('/img/working-bg.jpg');
        margin: 0;
        padding: 0;
     height: 100%;
      }
      .custom-col {
            flex: 0 0 auto;
            width: 20%; /* Anda bisa menyesuaikan lebar ini */
      }
    </style>
     <style>
       .carousel-custom {
  width: 140%;
  max-width: 800px;
  margin-left: -20%; /* Sesuaikan nilai ini sesuai kebutuhan untuk menggeser ke kiri */
  margin-right: auto; /* Menjaga elemen tetap terpusat pada bagian kanan */
}
      </style>
  </head>
  <body>

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand text-primary bg-white p-2 rounded-3" href="#">
            <img src="{{ asset('/img/logo.svg') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            SATPAS POLRESTA TANJUNG PINANG 0904
          </a>

          <div class="d-flex">
            <h6 class="text-white">{{ 'Jakarta, ' . date('d-M-Y'); }}</h6>
          </div>
        </div>
    </nav>

    <div class="container-fluid px-3 mt-1 position-relative" style="min-height:91vh !important; padding-bottom:100px;">
        <div class="row">
          <!-- Antrian Loket -->
          <div class="col-md-auto custom-col">
            <div class="card text-center mb-3">
              @if (!$loket1->count())
                <h5>Belum Ada Antrian</h5>
              @else
                <h5 class="card-header bg-primary text-white">{{ strtoupper($loket1[0]->loket->deskripsi) }}</h5>
                <div class="card-body">
                  <h5 class="card-title">Nomor Antrian</h5>
                  <h1 class="card-text" id="loket1-antrian" style="font-size: 100px; margin: 0;">{{ $loket1[0]->no_antrian }}</h1>
                </div>
                <h5 class="card-header bg-primary text-white">LOKET {{ $loket1[0]->loket->id }}</h5>
              @endif
            </div>
          </div>
          <div class="col-md-auto custom-col">
            <div class="card text-center mb-3">
              @if (!$loket2->count())
                <h5>Belum Ada Antrian</h5>
              @else
                <h5 class="card-header bg-primary text-white">{{ strtoupper($loket2[0]->loket->deskripsi) }}</h5>
                <div class="card-body">
                  <h5 class="card-title">Nomor Antrian</h5>
                  <h1 class="card-text" id="loket2-antrian" style="font-size: 100px; margin: 0;">{{ $loket2[0]->no_antrian }}</h1>
                </div>
                <h5 class="card-header bg-primary text-white">LOKET {{ $loket2[0]->loket->id }}</h5>
              @endif
            </div>
          </div>
          <div class="col-md-auto custom-col">
            <div class="card text-center mb-3">
              @if (!$loket3->count())
                <h5>Belum Ada Antrian</h5>
              @else
                <h5 class="card-header bg-primary text-white">{{ strtoupper($loket3[0]->loket->deskripsi) }}</h5>
                <div class="card-body">
                  <h5 class="card-title">Nomor Antrian</h5>
                  <h1 class="card-text" id="loket2-antrian" style="font-size: 100px; margin: 0;">{{ $loket3[0]->no_antrian }}</h1>
                </div>
                <h5 class="card-header bg-primary text-white">LOKET {{ $loket3[0]->loket->id }}</h5>
              @endif
            </div>
          </div>
          <div class="col-md-auto custom-col">
            <div class="card text-center mb-3">
              @if (!$loket4->count())
                <h5>Belum Ada Antrian</h5>
              @else
                <h5 class="card-header bg-primary text-white">{{ strtoupper($loket4[0]->loket->deskripsi) }}</h5>
                <div class="card-body">
                  <h5 class="card-title">Nomor Antrian</h5>
                  <h1 class="card-text" id="loket2-antrian" style="font-size: 100px; margin: 0;">{{ $loket4[0]->no_antrian }}</h1>
                </div>
                <h5 class="card-header bg-primary text-white">LOKET {{ $loket4[0]->loket->id }}</h5>
              @endif
            </div>
          </div>
          <div class="col-md-auto custom-col">
            <div class="card text-center mb-3">
              @if (!$loket5->count())
                <h5>Belum Ada Antrian</h5>
              @else
                <h5 class="card-header bg-primary text-white">{{ strtoupper($loket5[0]->loket->deskripsi) }}</h5>
                <div class="card-body">
                  <h5 class="card-title">Nomor Antrian</h5>
                  <h1 class="card-text" id="loket2-antrian" style="font-size: 100px; margin: 0;">{{ $loket5[0]->no_antrian }}</h1>
                </div>
                <h5 class="card-header bg-primary text-white">LOKET {{ $loket5[0]->loket->id }}</h5>
              @endif
            </div>
          </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-4">
                <img src="/img/kapolrestp.png" style="width: 100%; max-width: 297px; height: auto; display: block; margin: auto;" alt="Side Image Left">
            </div>
            <div class="col-4">
                <div class="carousel slide carousel-custom" data-bs-ride="carousel" id="carouselExampleInterval">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="/img/slide2.png" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="/img/slide1.jpg" class="d-block w-100" alt="Slide 1">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-4">
                <img src="/img/kasattp.png" class="static-img" style="width: 100%; max-width: 290px; height: auto; display: block; margin: auto;" alt="Side Image Right">
            </div>
              <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
            </div>
        </div>

        <div class="footer position-absolute mx-0 start-0 end-0 bottom-0 border-top border-4 border-success">
          <div class="card bg-dark rounded-0">
              <div class="card-body">
                <marquee behavior="" direction="" class="text-white">
                  <img src="/img/logo.svg" width="30" height="30" alt=""> Selamat Datang di Sistem Informasi Antrian Satpas Kota Tanjung Pinang </marquee>
              </div>
          </div>
      </div>
      </div>
      <script>
        $(document).ready(function() {
            function fetchAntrian() {
    $.ajax({
        url: '/antrian/update', // Sesuaikan URL dengan endpoint yang benar
        type: 'GET',
        success: function(data) {
            // Perbarui tampilan antrian dengan data yang diterima
            if(data.loket1 !== 'Belum Ada Antrian') {
                $('#loket1-antrian').text(data.loket1);
            } else {
                $('#loket1-antrian').text(data.loket1);
            }

            if(data.loket2 !== 'Belum Ada Antrian') {
                $('#loket2-antrian').text(data.loket2);
            } else {
                $('#loket2-antrian').text(data.loket2);
            }

            // if(data.loket3 !== 'Belum Ada Antrian') {
            //     $('#loket3-antrian').text(data.loket3);
            // } else {
            //     $('#loket3-antrian').text(data.loket3);
            // }
        }
    });
}


            // Set interval untuk memperbarui antrian setiap 5 detik
            setInterval(fetchAntrian, 5000);
        });
        </script>
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Refresh seluruh halaman setiap 30 detik
        setInterval(function() {
            window.location.reload();
        }, 20000);
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
