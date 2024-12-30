<?php
namespace App\Http\Controllers;

use App\Models\HewanCategory;
use App\Models\JenisCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori
        $hewanCategories = HewanCategory::all();
        $jenisCategories = JenisCategory::all();

        // Query untuk produk
        $query = Product::query();

        // Filter berdasarkan kategori hewan
        if ($request->has('hewan') && $request->hewan != 'all') {
            $query->where('animal_category_id', $request->hewan);
        }

        // Filter berdasarkan kategori jenis
        if ($request->has('jenis') && $request->jenis != 'all') {
            $query->where('jenis_category_id', $request->jenis);
        }

        // Ambil produk sesuai filter
        $products = $query->get();

        return view('user.shop', compact('hewanCategories', 'jenisCategories', 'products'));
    }

    
}
