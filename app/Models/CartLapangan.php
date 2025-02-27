<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lapangan;
use Illuminate\Database\Eloquent\Model;

class CartLapangan extends Model
{
    protected $table = 'cart_lapangan';

    protected $fillable = [
        'user_id', 'lapangan_id', 'nama', 'harga', 'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'lapangan_id');
    }
}
