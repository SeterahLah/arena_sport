<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Produk;
use App\Models\CartLapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    // Menampilkan cart berdasarkan user login
    // Menampilkan cart
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('produk')->get();
        $totalPrice = $cartItems->sum(fn ($item) => $item->quantity * $item->harga);
        return view('layout.navbar', compact('cartItems', 'totalPrice'));
    }

    // Menambah produk ke cart
    public function addToCart(Request $request)
    {
        $produk = Produk::findOrFail($request->product_id);
        $user = auth()->user();

        $cart = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $produk->id
            ],
            [
                'nama' => $produk->nama,
                'quantity' => \DB::raw('quantity + 1'),
                'harga' => $produk->harga
            ]
        );

        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

        return back()->with('success', 'Product added to cart');
    }

    // Mengupdate jumlah barang di cart
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart updated']);
    }

    // Menghapus item dari cart
    public function removeCart($id)
    {
        Cart::findOrFail($id)->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }

    // Checkout
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalPrice = $cartItems->sum(fn ($item) => $item->quantity * $item->price);

        // Proses pembayaran atau simpan ke orders table

        Cart::where('user_id', Auth::id())->delete(); // Kosongkan cart setelah checkout

        return response()->json(['message' => 'Checkout successful', 'total' => $totalPrice]);
    }
}
