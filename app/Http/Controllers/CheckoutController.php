<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Ambil data pengguna yang sedang login
        $pengguna = Auth::user();

        // Ambil keranjang pengguna beserta relasi items dan product
        $cart = Cart::where('user_id', $pengguna->id)
            ->with('items.product') // Load relasi items dan product
            ->first();

        // Jika keranjang kosong
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.view')->with('warning', 'Keranjang Anda kosong.');
        }

        // Hitung subtotal
        $subtotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price; // Harga per item * jumlah
        });

        // Hitung total berat (dalam gram)
        $totalWeightInGram = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->berat; // Berat total dalam gram
        });

        // Konversi berat ke kilogram dan hitung ongkir
        $totalWeightInKg = ceil($totalWeightInGram / 1000); // Pembulatan ke atas
        $shippingRatePerKg = 15000; // Tarif per kilogram
        $ongkir = $totalWeightInKg * $shippingRatePerKg;

        // Hitung total keseluruhan
        $total = $subtotal + $ongkir;

        // Kirim variabel ke view
        return view('user.checkout', [
            'cartItems' => $cart->items,
            'subtotal' => $subtotal,
            'totalWeightInGram' => $totalWeightInGram,
            'ongkir' => $ongkir,
            'total' => $total,
        ]);
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'bank' => 'required|string',
        ]);

        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Ambil keranjang pengguna
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        // Jika keranjang kosong
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.view')->with('warning', 'Keranjang Anda kosong.');
        }

        // Hitung subtotal
        $subtotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Hitung total berat dan ongkir
        $totalWeightInGram = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->berat;
        });
        $totalWeightInKg = ceil($totalWeightInGram / 1000); // Konversi gram ke kilogram
        $shippingRatePerKg = 15000; // Tarif per kilogram
        $ongkir = $totalWeightInKg * $shippingRatePerKg;

        // Hitung total keseluruhan
        $total = $subtotal + $ongkir;

        // Simpan order ke database
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'province' => $validated['province'],
            'postal_code' => $validated['postal_code'],
            'phone' => $validated['phone'],
            'email' => $user->email,
            'message' => $validated['message'] ?? null,
            'subtotal' => $subtotal,
            'shipping_fee' => $ongkir,
            'total' => $total,
            'payment_method' => $validated['bank'],
            'payment_status' => 'Menunggu',
            'order_status' => 'Proses',
        ]);

        // Simpan setiap item dalam order dan kurangi stok produk
        foreach ($cart->items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'subtotal' => $cartItem->quantity * $cartItem->product->price,
            ]);

            $product = Product::find($cartItem->product_id);
            if ($product) {
                $product->decrement('stock', $cartItem->quantity);
            }
        }

        // Hapus keranjang setelah checkout
        $cart->items()->delete();
        $cart->delete();

        // Redirect ke halaman sukses
        return redirect()->route('user.index', ['orderId' => $order->id])
            ->with('success', 'Pesanan Anda berhasil dibuat!');
    }



    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('checkout-success', compact('order'));
    }
}
