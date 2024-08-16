<?php

namespace App\Http\Controllers;

use App\Models\SatisfactionSurvey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'satisfaction_level' => 'required|integer',
        ]);

        // Simpan data ke database
        $survey = new SatisfactionSurvey();
        $survey->response = $validatedData['satisfaction_level'];
        $survey->save();

        // Redirect dengan pesan sukses
        return redirect('/loket-antrian')->with('success', 'Terima kasih atas tanggapan Anda!');
    }
    public function report(Request $request)
    {
        // Menerima parameter filter jika ada
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Membuat query dasar
        $query = SatisfactionSurvey::query();

        // Memfilter data berdasarkan tanggal jika filter diberikan
        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
        }

        // Menjalankan query dan mendapatkan hasilnya
        $surveys = $query->orderBy('created_at', 'desc')->get();

        return view('dashboard.laporan.survey', compact('surveys'));
    }
}
