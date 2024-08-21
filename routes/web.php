<?php

use App\Models\Loket;
use App\Models\Antrian;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Scope;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\CetakAntrianController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RegpasienController;
use App\Models\RegPasien;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SurveyController;
use App\Models\Dokter;
use App\Models\User;

Route::get('/loket-antrian', function () {
    return view('dashboard', [
        'loket' => Loket::all()
    ]);
});
// Route untuk menampilkan daftar loket
Route::get('/survey-report', [SurveyController::class, 'report'])->name('survey.report');

Route::get('antrian/cetak/{jenis}/{id}', [AntrianController::class, 'cetakAntrian'])->name('antrian.cetak');
// Route untuk menampilkan form membuat loket baru
// Route::get('loket/create', [LoketController::class, 'create'])->name('loket.create')->middleware('isAdmin');

// // Route untuk menyimpan loket baru
// Route::post('loket', [LoketController::class, 'store'])->name('loket.store')->middleware('isAdmin');

// // Route untuk menampilkan detail loket
// Route::get('loket/{id}', [LoketController::class, 'show'])->name('loket.show')->middleware('isAdmin');

// // Route untuk menampilkan form edit loket
// Route::get('loket/{id}/edit', [LoketController::class, 'edit'])->name('loket.edit')->middleware('isAdmin');

// // Route untuk mengupdate data loket
// Route::put('loket/{id}', [LoketController::class, 'update'])->name('loket.update')->middleware('isAdmin');

// // Route untuk menghapus loket
// Route::delete('loket/{id}', [LoketController::class, 'destroy'])->name('loket.destroy')->middleware('isAdmin');
Route::get('/', [LoginController::class, 'index']);

Route::get('/plasma', function () {
    return view('plasma', [
        'loket1' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('status', 'pendaftaran')
            ->where('loket_id', 1)
            ->orderBy('created_at', 'asc')
            ->get(),
        'loket2' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('status', 'registrasi')
            ->where('loket_id', 2)
            ->orderBy('created_at', 'asc')
            ->get(),
        'loket3' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('status', 'foto_cetak')
            ->where('loket_id', 3)
            ->orderBy('created_at', 'asc')
            ->get(),
        'loket4' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('status', 'ujian_teori')
            ->where('loket_id', 4)
            ->orderBy('created_at', 'asc')
            ->get(),
        'loket5' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('status', 'ujian_praktek')
            ->where('loket_id', 5)
            ->orderBy('created_at', 'asc')
            ->get()
    ]);
});


Route::get('/dashboard/plasma-antrian', [AntrianController::class, 'plasmaAntrian'])->middleware('auth');
Route::post('/dashboard/get-plasma', [AntrianController::class, 'getPlasmaAntrian'])->middleware('auth');


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'pasien' => Loket::all(),
        'dokter' => User::all(),
        'antrian' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('status', 0)->get()
    ]);
})->middleware('auth');

Route::resource('/dashboard/users', UserController::class)->scoped(['user' => 'username'])->middleware('isAdmin');
Route::resource('/dashboard/loket', LoketController::class)->middleware('isAdmin');
Route::resource('/dashboard/pendaftaran', PendaftaranController::class)->middleware('auth');
Route::resource('/dashboard/layanan', LayananController::class)->middleware('isAdmin');
Route::resource('/dashboard/dokter', DokterController::class)->middleware('isAdmin');



//registrasi pasien
Route::post('/dashboard/regpasien', [RegpasienController::class, 'store'])->middleware('auth');




Route::get('/dashboard/antrian', [AntrianController::class, 'index'])->middleware('auth');
Route::post('/dashboard/antrian', [AntrianController::class, 'store'])->middleware('auth');
Route::get('/dashboard/antrian/{id}/{tipe}', [AntrianController::class, 'getRowId'])->middleware('auth');
Route::get('/dashboard/antrian/{loket}', [AntrianController::class, 'getLoketId'])->middleware('auth');

Route::get('/antrian/pasien_bpjs/{id}', [CetakAntrianController::class, 'cetakBpjs']);
Route::get('/antrian/pasien_umum/{id}', [CetakAntrianController::class, 'cetakUmum']);


Route::get('/antrian/cetak_antrian_bpjs', function () {
    return view('antrian.cetak_antrian_bpjs', [
        'tiket' => Antrian::latest()->where('loket_id', 1)->where('status', 0)->get()
    ]);
});

Route::get('/antrian/cetak_antrian_umum', function () {
    return view('antrian/cetak_antrian_umum', [
        'tiket' => Antrian::latest()->where('loket_id', 2)->where('status', 0)->get()
    ]);
});
// Contoh definisi route
Route::post('/dashboard/antrian/getRowId/{id}/finish', 'AntrianController@getRowId')->name('antrian.finish');

Route::get('/dashboard/laporan', [laporanController::class, 'index'])->middleware('auth');
Route::post('/dashboard/laporan/cetak', [laporanController::class, 'cetak'])->middleware('auth');

Route::get('/api/antrian/{loket}', [AntrianController::class, 'apiGetLoketId'])->middleware('auth');
Route::post('/submit-survey', [SurveyController::class, 'store'])->name('submit-survey');
// 'tiket' => DB::table('antrians')
//             ->where('loket_id', '=', 1)
//             ->where('status', '=', 0)
//             ->get()
Route::get('/antrian/update', function () {
    $loket1 = Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
        ->where('status', 'pendaftaran') // Hanya ambil antrian dengan status 'belum'
        ->where('loket_id', 1)
        ->orderBy('created_at', 'asc')
        ->first();

    $loket2 = Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
        ->where('status', 'registrasi')
        ->where('loket_id', 2)
        ->orderBy('created_at', 'asc')
        ->first();

    $loket3 = Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
        ->where('status', 'foto_cetak')
        ->where('loket_id', 3)
        ->orderBy('created_at', 'asc')
        ->first();
    $loket4 = Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
        ->where('status', 'ujian_teori')
        ->where('loket_id', 4)
        ->orderBy('created_at', 'asc')
        ->first();
    $loket5 = Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
        ->where('status', 'ujian_praktek')
        ->where('loket_id', 5)
        ->orderBy('created_at', 'asc')
        ->first();
    return response()->json([
        'loket1' => $loket1 ? $loket1->no_antrian : 'Belum Ada Antrian',
        'loket2' => $loket2 ? $loket2->no_antrian : 'Belum Ada Antrian',
        'loket3' => $loket3 ? $loket3->no_antrian : 'Belum Ada Antrian',
        'loket4' => $loket4 ? $loket4->no_antrian : 'Belum Ada Antrian',
        'loket5' => $loket5 ? $loket5->no_antrian : 'Belum Ada Antrian'
    ]);
});
