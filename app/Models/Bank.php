<?php

namespace App\Models;

use App\Models\KategoriBank;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $fillable = ['nama', 'rekening', 'bank'];

    public function kategoriBank()
    {
        return $this->belongsTo(KategoriBank::class, 'bank');
    }
}
