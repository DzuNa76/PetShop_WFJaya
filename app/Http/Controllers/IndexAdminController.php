<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexAdminController extends Controller
{
    public function index()
    {
        // Menghitung penghasilan total dari semua orderan
        $totalRevenue = Order::sum('subtotal'); // Sesuaikan 'total_price' dengan nama kolom yang menyimpan total harga pada tabel order

        // Menghitung jumlah total orderan yang masuk
        $totalOrders = Order::count();

        // Menghitung jumlah total produk yang ada
        $totalProducts = Product::count();

        return view('admin.indexadmin', compact('totalRevenue', 'totalOrders', 'totalProducts'));
    }

    public function getMonthlyEarnings()
    {
        $earnings = DB::table('orders')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(subtotal) as total_earnings')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        return response()->json($earnings);
    }

    public function yourFunctionName()
    {
        $newOrders = Order::where('order_status', 'Proses')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.notifications', compact('newOrders'));
    }

}
