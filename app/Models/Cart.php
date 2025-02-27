<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';

    protected $fillable = [
       'user_id', 'product_id', 'nama', 'harga', 'quantity'
    ];
    // protected $fillable = [
    //     'user_id',  'nama', 'total_harga','catatan','email','telepon', 'quantity','midtrans_order_id','alamat','status', 'provinsi', 'courier', 'shipping_cost'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
