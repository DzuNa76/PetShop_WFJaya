<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->only('payment_status', 'order_status'));
        $request->validate([
            'payment_status' => 'required|in:Menunggu,Diterima,Gagal',
            'order_status' => 'required|in:Proses,Dikirim,Diterima,Ditolak',
        ]);        

        return redirect()->route('order.index')->with('success', 'Order status updated successfully.');
    }

    // Report
    public function cetak()
    {
        $orders = Order::all();
        $pdf = Pdf::loadview('admin.order.cetak', compact('orders'));
        return $pdf->download('laporan-order.pdf');
    }

    public function cetak2($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        $pdf = Pdf::loadview('admin.order.cetakShow', compact('order'));
        return $pdf->download("Invoice_pelanggan_{$order->id}.pdf");
    }
}
