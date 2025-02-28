<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment($orderId)
{
    $order = Order::where('midtrans_order_id', $orderId)->firstOrFail();

    \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $order->midtrans_order_id,
            'gross_amount' => $order->total_harga,
        ],
        'customer_details' => [
            'first_name' => $order->nama,
            'email' => $order->email,
            'phone' => $order->telepon,
            'address' => $order->alamat,
        ]
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);
    return view('payment.midtrans', compact('snapToken', 'order'));
}

public function callback(Request $request)
{
    $notif = new \Midtrans\Notification();

    $order = Order::where('midtrans_order_id', $notif->order_id)->first();

    if ($notif->transaction_status == 'settlement') {
        $order->update(['status' => 'processing']);
    }

    return response()->json(['message' => 'Payment status updated']);
}
}
