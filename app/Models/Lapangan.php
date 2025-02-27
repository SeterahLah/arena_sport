<?php

namespace App\Models;

use App\Models\KategoriOlahraga;
use App\Models\KategoriFasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lapangan extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $table = 'lapangans';
    protected $fillable = ['nama', 'deskripsi', 'harga', 'fasilitas', 'id_kategori', 'waktu', 'tanggal', 'alamat','status', 'gambar', 'user_id'];
    protected $casts = [
        'gambar' => 'array', // Konversi gambar ke array
        'fasilitas' => 'array',
    ];

    public function KategoriOlahraga()
    {
        return $this->belongsTo(KategoriOlahraga::class, 'id');
    }
    public function KategoriFasilitas()
    {
        return $this->belongsTo(KategoriFasilitas::class, 'id');
    }
}
