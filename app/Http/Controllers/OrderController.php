<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class OrderController extends Controller
{

    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('produk')->get();
        $orders = Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('orders.produk.index', compact('orders', 'cartItems'));
    }
    public function checkout(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('produk')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong!');
        }

        // Hitung total harga
        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->price);
        $shippingCost = 20000; // Contoh biaya ongkir (nanti bisa pakai API RajaOngkir)

        // Buat order baru
        $order = Order::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'province' => $request->province,
            'destination' => $request->destination,
            'courier' => $request->courier,
            'catatan' => $request->catatan,
            'shipping_cost' => $shippingCost,
            'total_harga' => $subtotal + $shippingCost,
            'midtrans_order_id' => 'MID-' . strtoupper(Str::random(10)), // Buat ID unik otomatis
            'status' => 'pending',
        ]);

        // Pindahkan item dari cart ke order_item
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'harga' => $item->price,
            ]);
        }

        // Hapus cart setelah checkout
        Cart::where('user_id', $user->id)->delete();

        // Proses Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $transactionDetails = [
            'order_id' => $order->midtrans_order_id,
            'gross_amount' => $order->total_harga,
        ];

        $customerDetails = [
            'first_name' => $order->nama,
            'email' => $order->email,
            'phone' => $order->telepon,
        ];

        $midtransParams = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        $snapToken = Snap::getSnapToken($midtransParams);

        return view('orders.payment', compact('order', 'snapToken'));
    }
}
