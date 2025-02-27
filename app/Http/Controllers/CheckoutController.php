<?php

namespace App\Http\Controllers;

use App\Models\Bank;


use App\Models\Cart;
use App\Models\KategoriBank;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $bank = KategoriBank::all();
        $cartItems = Cart::where('user_id', Auth::id())->with('produk')->get();
        $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        return view('checkout.produk.index', compact('cartItems', 'totalPrice', 'bank'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'total_harga' => 'required|string',
            'alamat' => 'required|string',
            'destination' => 'required|string',
            'courier' => 'required|string',
            'shipping_cost' => 'required|string',
            'midtrans_order_id' => 'required|string',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout.index')->with('error', 'Cart is empty!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'provinsi' => $request->alamat,
            'destination' => $request->destination,
            'courier' => $request->courier,
            'catatan' => $request->catatan,
            'shipping_cost' => $request->shipping_cost,
            'total_harga' => $cartItems->sum(fn($item) => $item->quantity * $item->price),
            'midtrans_order_id' => $request->midtrans_order_id,
            'status' => 'pending',
        ]);

        $cartItems->each(function ($cartItem) use ($order) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'harga' => $cartItem->harga,
                'quantity' => $cartItem->quantity,
            ]);
        });

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.index')->with('success', 'Order placed successfully!');
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'destination' => 'required',
            'courier' => 'required',
            'shipping_cost' => 'required|numeric',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Cart is empty.');
        }

        DB::beginTransaction();

        try {
            // Simpan Order dengan ongkir
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice + $request->shipping_cost,
                'shipping_address' => $request->shipping_address,
                'status' => 'pending',
            ]);

            // Simpan detail pesanan
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
            DB::commit();

            return redirect()->route('checkout')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout')->with('error', 'Checkout failed, please try again.');
        }
    }
}
