<?php

namespace App\Models;

use App\Models\Lapangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriOlahraga extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kategori_olahragas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nama', 'gambar'];

    public function lapangan()
    {
        return $this->hasMany(Lapangan::class, 'id_kategori');
    }
}
