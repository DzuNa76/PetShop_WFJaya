<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::all();
        return view('admin.shipping.index', compact('shippings'));
    }

    public function create()
    {
        // Mengambil data orders yang tersedia
        $orders = Order::select('id', 'address', 'subtotal', 'shipping_fee', 'user_id')->get();

        // Mengirimkan data orders ke view
        return view('admin.shipping.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'method' => 'required|string|max:50',
            'tracking_number' => 'nullable|string|max:50',
            'sent_at' => 'nullable|date',
        ]);

        // Ambil data order berdasarkan order_id
        $order = Order::findOrFail($request->order_id);

        // Perbarui status pesanan menjadi 'Dikirim'
        $order->order_status = 'Dikirim';
        $order->save();

        // Buat data pengiriman baru
        Shipping::create([
            'order_id' => $request->order_id,
            'user_id' => $order->user_id,
            'address' => $order->address,
            'method' => $request->method,
            'shipping_fee' => $order->shipping_fee,
            'order_address' => $order->address,
            'tracking_number' => $request->tracking_number,
            'sent_at' => $request->sent_at,
            'received_at' => null, // Default null
        ]);

        return redirect()->route('shipping.index')->with('success', 'Pengiriman berhasil ditambahkan dan status order diperbarui.');
    }


    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        $orders = Order::select('id', 'address', 'subtotal', 'shipping_fee', 'user_id')->get();
        return view('admin.shipping.edit', compact('shipping', 'orders'));
    }

    public function update(Request $request, $id)
    {
        $shipping = Shipping::findOrFail($id);

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'method' => 'required|string|max:50',
            'tracking_number' => 'nullable|string|max:50',
            'sent_at' => 'nullable|date',
            'received_at' => 'nullable|date',
        ]);

        // Ambil data order berdasarkan order_id
        $order = Order::findOrFail($request->order_id);

        // Update data pengiriman
        $shipping->update([
            'order_id' => $request->order_id,
            'user_id' => $order->user_id, // Ambil user_id dari tabel orders
            'address' => $order->address, // Ambil alamat dari tabel orders
            'method' => $request->method,
            'shipping_fee' => $order->shipping_fee, // Ambil shipping_fee dari tabel orders
            'tracking_number' => $request->tracking_number,
            'sent_at' => $request->sent_at,
            'received_at' => $request->received_at,
        ]);

        return redirect()->route('shipping.index')->with('success', 'Pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();
        return redirect()->route('shipping.index')->with('success', 'Pengiriman berhasil dihapus.');
    }

    public function cetak()
    {
        $shippings = Shipping::all();
        $pdf = Pdf::loadView('admin.shipping.cetak', compact('shippings'));
        return $pdf->download('shipping-list.pdf');
    }
}
