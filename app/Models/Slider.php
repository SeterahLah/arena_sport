<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    

    protected $fillable = ['nama', 'deskripsi_singkat','url', 'pilihan', 'gambar'];

    
}
