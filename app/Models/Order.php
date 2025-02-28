<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    

    protected $fillable = ['user_id', 'nama', 'email', 'telepon', 'alamat', 'province', 'destination', 'courier', 'catatan', 'resi_pengiriman', 'shipping_cost', 'total_harga', 'midtrans_order_id', 'status'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
