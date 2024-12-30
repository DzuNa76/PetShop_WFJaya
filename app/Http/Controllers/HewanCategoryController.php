<?php

namespace App\Http\Controllers;

use App\Models\HewanCategory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HewanCategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $hewans = HewanCategory::all(); // Ambil semua data kategori
        return view('admin.hewan.index', compact('hewans'));
    }

    // Form tambah kategori
    public function create()
    {
        // Ambil ID terakhir dari tabel kategori, jika kosong, gunakan default 1
        $lastId = HewanCategory::max('id') + 1 ?? 1;

        return view('admin.hewan.create', compact('lastId'));
    }


    // Simpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'namaHewan' => 'required|string|max:255',
        ]);

        HewanCategory::create([
            'name' => $request->namaHewan, // Simpan nama kategori
        ]);

        return redirect()->route('hewan.index')->with('success', 'Hewan berhasil ditambahkan!');
    }


    // Form edit kategori
    public function edit($id)
    {
        $hewan = HewanCategory::findOrFail($id);
        return view('admin.hewan.edit', compact('hewan'));
    }

    // Update data kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hewan = HewanCategory::findOrFail($id);
        $hewan->update([
            'name' => $request->name,
        ]);

        return redirect()->route('hewan.index')->with('success', 'Hewan berhasil diperbarui!');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $hewan = HewanCategory::findOrFail($id);
        $hewan->delete();

        return redirect()->route('hewan.index')->with('success', 'Hewan berhasil dihapus!');
    }

    // Report
    public function cetak()
    {
        $hewans = HewanCategory::all();
        $pdf = Pdf::loadview('admin.hewan.cetak', compact('hewans'));
        return $pdf->download('laporan-hewan_category.pdf');
    }
}
