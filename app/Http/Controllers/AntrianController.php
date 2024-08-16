<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Antrian;
use App\Models\Layanan;
use \App\Models\Loket;
use App\Models\RegPasien;

class AntrianController extends Controller
{
    // ...
    public function index(Request $request)
    {
        $loketId = $request->id_loket;
        $antrian = collect(); // Gunakan collection kosong sebagai default jika tidak ada loket yang dipilih
        $selectedLoket = null;

        if ($loketId) {
            $antrian = Antrian::where('loket_id', $loketId)
                ->whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
                ->orderBy('created_at', 'asc')
                ->get();
            $selectedLoket = Loket::find($loketId);
        }

        return view('dashboard.antrian.index', [
            'antrian' => $antrian,
            'loket' => Loket::all(), // Mengirim semua loket untuk dropdown
            'selectedLoket' => $selectedLoket // Mengirim loket yang dipilih untuk menampilkan informasi loket
        ]);
    }


    public function plasmaAntrian()
    {
        return view('dashboard.antrian.plasma_antrian', [
            'poli' => Layanan::all()
        ]);
    }

    public function getPlasmaAntrian(Request $request)
    {
        $query = RegPasien::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('layanan_id', $request->post('layanan_id'))
            ->get();

        return view('dashboard.antrian.get_antrian_poli', [
            'data' => $query,
            'layanan' => Layanan::where('id', $request->post('layanan_id'))->get()
        ]);
    }

    public function getRowId($id, $tipe)
    {
        $antrian = Antrian::where('id', $id)->first();

        if (!$antrian) {
            return response()->json(['error' => 'Antrian tidak ditemukan'], 404);
        }

        if ($tipe == 'next') {
            if ($antrian->status === 'pendaftaran') {
                // Pindah dari pendaftaran ke verifikasi
                $antrian->update([
                    'status' => 'verifikasi',
                    'loket_id' => 2 // Misalnya ID loket verifikasi adalah 2
                ]);
            } else if ($antrian->status === 'verifikasi') {
                // Selesaikan antrian
                $antrian->update(['status' => 'selesai']);
            }
        } else if ($tipe == 'previous') {
            if ($antrian->status === 'verifikasi') {
                // Kembali ke pendaftaran dari verifikasi
                $antrian->update([
                    'status' => 'pendaftaran',
                    'loket_id' => 1 // Misalnya ID loket pendaftaran adalah 1
                ]);
            } else if ($antrian->status === 'selesai') {
                // Kembali ke verifikasi jika sebelumnya selesai
                $antrian->update([
                    'status' => 'verifikasi',
                    'loket_id' => 2
                ]);
            }
        }

        return response()->json($antrian);
    }

    public function getLoketId($loketId)
    {
        $antrians = Antrian::where('loket_id', $loketId)->orderBy('created_at', 'asc')->get();
        $loket = Loket::find($loketId); // Pastikan Loket::find mengembalikan objek yang valid

        return view('dashboard.antrian.get_antrian', [
            'antrian' => $antrians,
            'loket' => $loket // Kirim data loket ke view
        ]);
    }
    public function apiGetLoketId($loketId)
    {
        $antrians = Antrian::where('loket_id', $loketId)->orderBy('created_at', 'asc')->get();
        $loket = Loket::find($loketId); // Pastikan Loket::find mengembalikan objek yang valid

        return response()->json([
            'antrian' => $antrians,
            'loket' => $loket
        ]);
    }
    public function cetakAntrian($jenis, $id)
    {

        $kode = ($jenis == 'baru') ? 'A' : 'B';
        $latestAntrian = Antrian::where('no_antrian', 'LIKE', $kode . '%')
            ->whereDate('created_at', today())
            ->latest('created_at')
            ->first();

        $no_urut = $latestAntrian ? ((int) substr($latestAntrian->no_antrian, 1) + 1) : 1;
        $no_antrian = $kode . str_pad($no_urut, 3, '0', STR_PAD_LEFT);

        Antrian::create([
            'loket_id' => 1,
            'no_antrian' => $no_antrian,
            'status' => 'pendaftaran'
        ]);

        return view('antrian.cetak', ['no_antrian' => $no_antrian]);
    }



    public function prosesAntrian(Request $request, $id)
    {
        $antrian = Antrian::findOrFail($id);

        if ($antrian->status == 'pendaftaran') {
            // Jika antrian selesai di loket pendaftaran, pindah ke verifikasi
            $antrian->update([
                'status' => 'verifikasi',
                'loket_id' => 2 // ID loket verifikasi
            ]);
        } else if ($antrian->status == 'verifikasi') {
            // Jika antrian selesai di loket verifikasi
            $antrian->update(['status' => 'selesai']);
        }

        return back()->with('success', 'Antrian berhasil diproses.');
    }
}
