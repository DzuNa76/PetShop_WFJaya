<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $shippings = Shipping::all();

        // Ambil semua order milik user yang sedang login
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product') // Relasi untuk detail produk
            ->get();

        return view('user.transactions', compact('orders', 'shippings')); 
    }

    public function completeOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Tandai pesanan selesai
        $order->update(['order_status' => 'completed']);

        return redirect()->route('user.transactions')->with('success', 'Pesanan berhasil diselesaikan.');
    }
    public function show($id = null)
    {
        $orders = Order::where('user_id', Auth::id())->get();

        $order = $id ? Order::with('items.product')->find($id) : null;

        return view('transactions', compact('orders', 'order'));
    }

    public function ajaxTransaction($id)
    {
        $order = Order::with('items.product')->find($id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan.']);
        }

        return response()->json([
            'success' => true,
            'order' => [
                'id' => $order->id,
                'created_at' => $order->created_at->format('d-m-Y H:i'),
                'order_status' => $order->order_status,
                'payment_status' => $order->payment_status,
                'name' => $order->name,
                'address' => $order->address,
                'city' => $order->city,
                'province' => $order->province,
                'postal_code' => $order->postal_code,
                'phone' => $order->phone,
                'email' => $order->email,
                'subtotal' => $order->subtotal,
                'shipping_fee' => $order->shipping_fee,
                'total' => $order->total,
                'payment_method' => $order->payment_method,
                'items' => $order->items->map(function ($item) {
                    return [
                        'product' => [
                            'name' => $item->product->name,
                            'price' => $item->product->price,
                        ],
                        'quantity' => $item->quantity,
                        'subtotal' => $item->subtotal,
                    ];
                }),
            ],
        ]);
    }

}
