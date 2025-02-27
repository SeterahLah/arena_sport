<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nama', 'deskripsi', 'alamat', 'harga', 'status', 'kategori', 'stok', 'berat', 'gambar'];

    protected $casts = [
        'gambar' => 'array', // Konversi gambar ke array
        // 'fasilitas' => 'array'
    ];

    // public function getGambarAttribute($value)
    // {
    //     if (is_string($value)) {
    //         $decoded = json_decode($value, true);
    //         return is_array($decoded) ? $decoded : [];
    //     }
    //     return [];
    // }
}
