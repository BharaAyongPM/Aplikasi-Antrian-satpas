<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    // Menampilkan daftar loket
    public function index()
    {
        $loket = Loket::all();
        return view('dashboard.loket.index', [
            'loket' => $loket
        ]);
    }

    // Menampilkan form untuk membuat loket baru
    public function create()
    {
        return view('dashboard.loket.create');
    }

    // Menyimpan loket baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_loket' => 'required|string|max:255',
            'kode' => 'required|string|max:10|unique:lokets',
            'deskripsi' => 'nullable|string'
        ]);

        Loket::create([
            'nama_loket' => $request->nama_loket,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('loket.index')->with('success', 'Loket berhasil dibuat.');
    }

    // Menampilkan detail loket
    public function show($id)
    {
        $loket = Loket::findOrFail($id);
        return view('dashboard.loket.show', [
            'loket' => $loket
        ]);
    }

    // Menampilkan form untuk mengedit loket
    public function edit($id)
    {
        $loket = Loket::findOrFail($id);
        return view('dashboard.loket.edit', [
            'loket' => $loket
        ]);
    }

    // Mengupdate data loket
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_loket' => 'required|string|max:255',
            'kode' => 'required|string|max:10|unique:lokets,kode,' . $id,
            'deskripsi' => 'nullable|string'
        ]);

        $loket = Loket::findOrFail($id);
        $loket->update([
            'nama_loket' => $request->nama_loket,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('loket.index')->with('success', 'Loket berhasil diperbarui.');
    }

    // Menghapus loket
    public function destroy($id)
    {
        $loket = Loket::findOrFail($id);
        $loket->delete();

        return redirect()->route('loket.index')->with('success', 'Loket berhasil dihapus.');
    }
}
