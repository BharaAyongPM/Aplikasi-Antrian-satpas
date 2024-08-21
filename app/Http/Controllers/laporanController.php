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
        $tahun = $request->post('tahun');

        // Menghitung jumlah antrian untuk pemohon baru ('A') dan perpanjangan ('B')
        $jumlahBaru = Antrian::whereYear('created_at', '=', $tahun)
            ->whereMonth('created_at', '=', $bulan)
            ->where('no_antrian', 'like', 'A%')
            ->count();
        $jumlahPerpanjangan = Antrian::whereYear('created_at', '=', $tahun)
            ->whereMonth('created_at', '=', $bulan)
            ->where('no_antrian', 'like', 'B%')
            ->count();

        return view('dashboard.laporan.cetak-laporan', [
            'jumlahBaru' => $jumlahBaru,
            'jumlahPerpanjangan' => $jumlahPerpanjangan,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
    }
}
