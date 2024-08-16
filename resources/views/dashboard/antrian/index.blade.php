@extends('dashboard.layouts.main')

@section('container')

    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-info text-white me-2">
          <i class="mdi mdi-ticket"></i>
        </span> Data Antrian Pemohon
      </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="col-lg-8 mb-2">
                    <form action="/dashboard/antrian" class="input-group">
                        <div class="col-md-6">
                            <select class="form-select loket mb-3" name="id_loket">
                                <option selected disabled>Pilih Loket</option>
                                @foreach ($loket as $l)
                                    <option value="{{ $l->id }}" {{ $l->id == request('id_loket') ? 'selected' : '' }}>{{ $l->nama_loket }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-sm btn-info mx-2">Pilih</button>
                            <a href="/loket-antrian" class="btn btn-sm btn-danger" target="_blank" rel="noopener noreferrer">Loket Antrian</a>
                            <a href="/plasma" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer">lihat plasma antrian</a>
                        </div>
                    </form>
                </div>

                @if ($antrian)
                <table class="table table-responsive table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th>No</th>
                            <th>No Antrian</th>
                            <th>Loket</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($antrian as $index => $a)
                        <tr id="rowId{{ $a->id }}">
                            <td width="50">{{ $loop->iteration }}</td>
                            <td>{{ $a->no_antrian }}</td>
                            <td>{{ $a->loket->deskripsi }}</td>
                            <td>
                                @if ($a->status == 'selesai')
                                    <span class="btn btn-sm btn-danger">
                                        <i class="mdi mdi-check"></i> Selesai
                                    </span>
                                    @elseif ($a->status == 'pendaftaran')
                                    <span class="btn btn-sm btn-success ">
                                        <i class="mdi mdi-info"></i> Verifikasi
                                    </span>
                                @elseif ($a->status == 'verifikasi')
                                    <span class="btn btn-sm btn-success ">
                                        <i class="mdi mdi-info"></i> Verifikasi
                                    </span>
                                @else
                                    {{ ucfirst($a->status) }}
                                @endif
                            </td>
                            <td width="250" class="tombolAksi">
                                <a href="" class="btn btn-sm btn-danger tombolPrevious" data-tipe="previous" data-id="{{ $a->id }}"><i class="mdi mdi-skip-previous"></i></a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-success tombolPanggil" data-id="{{ $a->id }}" data-nomor="{{ $a->no_antrian }}" data-loket="{{ $a->loket->deskripsi }}" onclick="panggilDanRefresh(this)"><i class="mdi mdi-bell-ring"></i> Panggil</a>
                                <a href="" class="btn btn-sm btn-danger tombolNext" data-tipe="next" data-id="{{ $a->id }}"><i class="mdi mdi-skip-next"></i> Sudah</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif
                <button type="button" class="btn btn-sm btn-primary ms-auto" onclick="location.reload();">Refresh</button>
              </div>
            </div>
        </div>
    </div>


    <script>
        const elements = document.getElementsByClassName('tombolNext')
        const bg = document.querySelectorAll('#bgTable')
        const tombolNext = document.querySelectorAll('.tombolNext')
        const tombolPrevious = document.querySelectorAll('.tombolPrevious')
        const tombolPanggil = document.querySelectorAll('.tombolPanggil')
        // const loket = document.querySelector('.loket')

        // console.log(loket)
        // loket.addEventListener('change', function(e) {
        //     fetch(`/dashboard/antrian/${loket.value}`).then(response => response.text()).then(response => {
        //         document.querySelector('.table').innerHTML = response
        //     })
        // })
        tombolNext.forEach(element => {
            element.addEventListener('click', function(e){
                e.preventDefault();
                const id = element.getAttribute('data-id')
                const tipe = element.getAttribute('data-tipe')

                fetch(`/dashboard/antrian/${id}/${tipe}`).then(response => response.json()).then(response => {
                    const rowId = document.getElementById('rowId'+response.id)
                    const tdId = document.querySelector('#rowId'+response.id+' td:nth-child(4)')
                    rowId.classList.add('table-danger')
                    tdId.innerHTML = response.status == 0 ? 'Belum' : 'Sudah'
                })


                // console.log(e.target.classList)


            })
        });

        tombolPrevious.forEach(element => {
            element.addEventListener('click', function(e){
                e.preventDefault();
                const id = element.getAttribute('data-id')
                const tipe = element.getAttribute('data-tipe')

                fetch(`/dashboard/antrian/${id}/${tipe}`).then(response => response.json()).then(response => {
                    const rowId = document.getElementById('rowId'+response.id)
                    const tdId = document.querySelector('#rowId'+response.id+' td:nth-child(4)')
                    rowId.classList.remove('table-danger')
                    tdId.innerHTML = response.status == 0 ? 'Belum' : 'Sudah'
                })


                // console.log(e.target.classList)


            })
        });

        tombolPanggil.forEach(element => {
    element.addEventListener('click', function(e){
        e.preventDefault();
        let nomor = this.getAttribute('data-nomor');
        let loket = this.getAttribute('data-loket');
        playSoundThenSpeak(nomor, loket);
    });
});

function playSoundThenSpeak(nomor, loket) {
    var tingSound = new Audio('../sound/sound.wav');// Pastikan path ini benar
    tingSound.play();

    tingSound.onended = function() {
        if(nomor && loket) {
            speak(`Nomor antrian ${nomor} masuk ke loket ${loket}`);
        } else {
            console.log('Data antrian atau loket tidak ada.');
        }
    };
}

function speak(text) {
    if ('speechSynthesis' in window) {
        var speech = new SpeechSynthesisUtterance(text);
        speech.lang = 'id-ID'; // Atur bahasa Indonesia
        window.speechSynthesis.speak(speech);
    } else {
        console.log("Browser tidak mendukung TTS");
    }
}

    </script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Fungsi untuk memperbarui data antrian
    function fetchAntrian() {
        const loketId = $('.loket').val(); // Ambil loket ID dari dropdown
        if (!loketId) return; // Jangan lakukan apa-apa jika tidak ada loket yang dipilih

        $.ajax({
            url: `/api/antrian/${loketId}`, // Endpoint API untuk mengambil data
            type: 'GET',
            success: function(data) {
                var rows = '';
                $.each(data.antrian, function(i, a) {
                    var statusText = a.status === 0 ? 'Belum' : 'Sudah';
                    var rowClass = a.status === 1 ? 'table-danger' : '';
                    rows += `<tr class="${rowClass}" id="rowId${a.id}">
                                <td width="50">${i + 1}</td>
                                <td>${a.no_antrian}</td>
                                <td>${data.loket.nama_loket}</td>
                                <td>${statusText}</td>
                                <td width="250" class="tombolAksi">
                                    <button class="btn btn-sm btn-danger tombolPrevious" data-tipe="previous" data-id="${a.id}"><i class="mdi mdi-skip-previous"></i></button>
                                    <button class="btn btn-sm btn-success tombolPanggil" onclick="panggilDanRefresh(${a.id}, '${a.no_antrian}', '${data.loket.nama_loket}')" data-id="${a.id}" data-nomor="${a.no_antrian}" data-loket="${data.loket.nama_loket}"><i class="mdi mdi-bell-ring"></i> Panggil</button>
                                    <button class="btn btn-sm btn-danger tombolNext" data-tipe="next" data-id="${a.id}"><i class="mdi mdi-skip-next"></i></button>
                                </td>
                            </tr>`;
                });
                $('tbody').html(rows);
            }
        });
    }

    // Interval untuk memperbarui antrian setiap 5 detik
    setInterval(fetchAntrian, 5000);

    // Memanggil fungsi saat dropdown loket berubah
    $('.loket').change(fetchAntrian);
});

// Fungsi untuk memanggil dan refresh
function panggilDanRefresh(id, nomor, loket) {
    // Logika untuk panggilan
    console.log(`Panggilan untuk nomor ${nomor} di loket ${loket}`);

    // Opsional: panggilan ke server untuk logika panggilan

    // Refresh view
    fetchAntrian(); // Anda dapat memanggil ini untuk memastikan tabel selalu update
}
</script> --}}


@endsection
