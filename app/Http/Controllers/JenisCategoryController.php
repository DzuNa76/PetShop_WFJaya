<?php

namespace App\Http\Controllers;

use App\Models\JenisCategory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class JenisCategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = JenisCategory::all(); // Ambil semua data kategori
        return view('admin.kategori.index', compact('categories'));
    }

    // Form tambah kategori
    public function create()
    {
        // Ambil ID terakhir dari tabel kategori, jika kosong, gunakan default 1
        $lastId = JenisCategory::max('id') + 1 ?? 1;

        return view('admin.kategori.create', compact('lastId'));
    }


    // Simpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:255',
        ]);

        JenisCategory::create([
            'name' => $request->namaKategori, // Simpan nama kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }


    // Form edit kategori
    public function edit($id)
    {
        $category = JenisCategory::findOrFail($id);
        return view('admin.kategori.edit', compact('category'));
    }

    // Update data kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = JenisCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = JenisCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    // Report
    public function cetak()
    {
        $categories = JenisCategory::all();
        $pdf = Pdf::loadview('admin.kategori.cetak', compact('categories'));
        return $pdf->download('laporan-Jenis.pdf');
    }

}
