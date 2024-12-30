<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'message',
        'subtotal',
        'shipping_fee',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(Pengguna::class);
    }

    // Relasi dengan model Product (jika order memiliki banyak produk)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
                    ->withPivot('quantity', 'price');
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id); // Mengambil order berdasarkan ID
        return view('invoice', compact('order'));
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

}
