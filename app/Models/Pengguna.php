<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $fillable = ['name', 'email', 'password', 'phone_number'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke Cart
    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }

    // Relasi ke CartItems melalui Cart
    public function cartItems()
    {
        return $this->hasManyThrough(CartItem::class, Cart::class, 'pengguna_id', 'cart_id');
    }
}