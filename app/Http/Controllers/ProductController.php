<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\JenisCategory;
use App\Models\HewanCategory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['jenisCategory', 'animalCategory'])->get();
        return view('admin.produk.index', compact('products'));
    }

    public function create()
    {
        $jenisCategories = JenisCategory::all();
        $animalCategories = HewanCategory::all();

        // Cari ID berikutnya (jika database kosong, mulai dari 1)
        $nextProductId = Product::max('id') + 1 ?? 1;

        return view('admin.produk.create', compact('jenisCategories', 'animalCategories', 'nextProductId'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'berat' => 'required|numeric',
            'jenis_category_id' => 'required|integer|exists:jenis_category,id',
            'animal_category_id' => 'required|integer|exists:animal_category,id',
            'description' => 'nullable|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        // Simpan file gambar
        $imagePath = $request->file('image_url')->store('imgProduk', 'public');

        // Simpan data produk
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'berat' => $request->berat,
            'jenis_category_id' => $request->jenis_category_id,
            'animal_category_id' => $request->animal_category_id,
            'description' => $request->description,
            'image_url' => $imagePath,
        ]);
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $jenisCategories = JenisCategory::all();
        $animalCategories = HewanCategory::all();
        return view('admin.produk.edit', compact('product', 'jenisCategories', 'animalCategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'jenis_category_id' => 'nullable|exists:jenis_category,id',
            'animal_category_id' => 'nullable|exists:animal_category,id',
            'berat' => 'nullable|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    // Report
    public function cetak()
    {
        $product = Product::all();
        $pdf = Pdf::loadview('admin.produk.cetak', compact('product'));
        return $pdf->download('laporan-produk.pdf');
    }

    // show product
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('user.detail', compact('product'));
    }

}
