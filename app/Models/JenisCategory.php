<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCategory extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'jenis_category';

    // Kolom yang dapat diisi
    protected $fillable = [
        'name',
    ];

    // Tambahkan timestamps jika tabel memiliki kolom created_at dan updated_at
    public $timestamps = true;
    protected $primaryKey = 'id';
}
