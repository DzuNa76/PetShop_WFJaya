<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Tambahkan produk ke keranjang.
     */
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $pengguna = Auth::user(); 
        $product = Product::findOrFail($validated['product_id']);

        $cart = Cart::firstOrCreate(['user_id' => $pengguna->id]);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->price = $product->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        $cart->total_price = $cart->items->sum('price');
        $cart->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Tampilkan isi keranjang.
     */
    public function viewCart()
    {
        $pengguna = Auth::user();

        $cart = Cart::where('user_id', $pengguna->id)
            ->with('items.product')
            ->first();

        if (!$cart) {
            return view('user.cart', ['cartItems' => [], 'cartSubtotal' => 0, 'cartTotal' => 0]);
        }

        $cartSubtotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $cartTotal = $cartSubtotal;

        return view('user.cart', [
            'cartItems' => $cart->items,
            'cartSubtotal' => $cartSubtotal,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function update(Request $request)
    {
        $cartItem = CartItem::where('id', $request->cart_item_id)->first();

        if (!$cartItem) {
            return response()->json(['status' => 'error', 'message' => 'Item tidak ditemukan.'], 404);
        }

        // Validasi jumlah (tidak boleh melebihi stok)
        $product = $cartItem->product;
        if ($request->quantity > $product->stock) {
            return response()->json(['status' => 'error', 'message' => 'Jumlah melebihi stok tersedia.'], 400);
        }

        // Update jumlah di database
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Hitung subtotal baru
        $subtotal = $cartItem->quantity * $cartItem->price;

        return response()->json([
            'status' => 'success',
            'subtotal' => $subtotal,
            'message' => 'Jumlah berhasil diperbarui.'
        ]);
    }

    /**
     * Menghapus item dari keranjang (AJAX).
     */
    public function deleteItem(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
        ]);

        $orderItem = CartItem::findOrFail($request->input('order_id'));

        if ($orderItem->cart->user_id !== Auth::id()) {
            return response()->json(['status' => 'unauthorized'], 403);
        }

        $orderItem->delete();

        $cart = $orderItem->cart;
        $cart->total_price = $cart->items->sum('price');
        $cart->save();

        return response()->json([
            'status' => 'deleted',
            'total_price' => number_format($cart->total_price, 0, ',', '.'),
        ]);
    }

    
}
