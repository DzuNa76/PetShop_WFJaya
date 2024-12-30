<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Gunakan nama tabel 'admin' sesuai dengan yang ada di database
    protected $table = 'admins';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'name',
        'alamat',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
