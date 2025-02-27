<?php

namespace App\Models;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBank extends Model
{
    use HasFactory;
    protected $table = 'kategori_bank';
    protected $fillable = ['nama_bank', 'gambar'];

    public function banks()
    {
        return $this->hasMany(Bank::class, 'bank');
    }
}
