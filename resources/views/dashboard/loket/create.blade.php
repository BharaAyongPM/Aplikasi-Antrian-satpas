@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <h1>Buat Loket Baru</h1>
    <form action="{{ route('loket.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_loket">Nama Loket</label>
            <input type="text" class="form-control" id="nama_loket" name="nama_loket" required>
        </div>
        <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
