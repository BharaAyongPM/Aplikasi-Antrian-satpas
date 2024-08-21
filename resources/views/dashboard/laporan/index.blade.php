@extends('dashboard.layouts.main')

@section('container')
{{-- @dd($bulan) --}}

  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-info text-white me-2">
        <i class="mdi mdi-account-multiple"></i>
      </span> Laporan Pemohon
    </h3>
  </div>
  <div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

          <div class="card-body">
            <div class="clearfix">
              <h4 class="card-title float-left">Laporan data antrian per Loket</h4>
            </div>




             {{-- Bagian pemilihan bulan --}}
             <form action="/dashboard/laporan/cetak" method="post">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="bulan" class="form-label">Pilih Bulan:</label>
                        <select class="form-select @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
                            <option selected disabled>Pilih bulan:</option>
                            @foreach ($bulan as $key => $bln)
                                <option value="{{ $key+1 }}">{{ $bln }}</option>
                            @endforeach
                        </select>
                        @error('bulan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="tahun" class="form-label">Pilih Tahun:</label>
                        <select class="form-select @error('tahun') is-invalid @enderror" name="tahun" id="tahun">
                            <option selected disabled>Pilih tahun:</option>
                            @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                        @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-cari-laporan">Cetak Laporan</button>
            </form>

<div class="d-flex justify-content-center mt-4">
    <a href="{{ route('survey.report') }}" class="btn btn-primary btn-lg">
      Lihat Survey Kepuasan
    </a>
</div>

          </div>
        </div>
      </div>

  </div>


@endsection


