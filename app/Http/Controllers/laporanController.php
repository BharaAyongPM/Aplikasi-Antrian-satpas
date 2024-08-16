<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\RegPasien;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Loket;

class laporanController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.laporan.index', [
            'bulan' => [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ]
        ]);
    }


    public function cetak(Request $request)
    {
        $bulan = $request->post('bulan');

        // Mengambil semua loket
        $loketList = Loket::all();

        // Menghitung jumlah antrian per loket
        $jumlahPerLoket = $loketList->mapWithKeys(function ($loket) use ($bulan) {
            return [
                $loket->nama_loket => Antrian::whereMonth('created_at', '=', $bulan)
                    ->where('loket_id', $loket->id)
                    ->count()
            ];
        });

        return view('dashboard.laporan.cetak-laporan', [
            'jumlahPerLoket' => $jumlahPerLoket,
            'bulan' => $bulan
        ]);
    }
}
