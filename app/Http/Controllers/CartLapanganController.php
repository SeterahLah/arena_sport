<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Lapangan;
use App\Models\CartLapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartLapanganController extends Controller
{
    public function index()
    {
        $lapangan1 = CartLapangan::where('user_id', Auth::id())->with('lapangan')->get();
        $totalPrice1 = $lapangan1->sum(fn ($item) => $item->quantity * $item->harga);
        return view('layout.navbar', compact('lapangan1', 'totalPrice1'));
    }

    // Menambah produk ke cart
    public function addToCart1(Request $request)
    {
        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $user = Auth::user();

        $cartlapangan = CartLapangan::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'lapangan_id' => $lapangan->id
            ],
            [
                'nama' => $lapangan->nama,
                'quantity' => \DB::raw('quantity + 1'),
                'harga' => $lapangan->harga
            ]
        );

        $cartCount = CartLapangan::where('user_id', $user->id)->sum('quantity');

        return back()->with('success', 'Product added to cart');
    }

    // Mengupdate jumlah barang di cart
    public function updateCart1(Request $request, $id)
    {
        $cart = CartLapangan::findOrFail($id);
        $cart->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart updated']);
    }

    // Menghapus item dari cart
    public function removeCart1($id)
    {
        CartLapangan::findOrFail($id)->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }

    // Checkout
    public function checkout1()
    {
        $cartItems = CartLapangan::where('user_id', Auth::id())->get();
        $totalPrice = $cartItems->sum(fn ($item) => $item->quantity * $item->price);

        // Proses pembayaran atau simpan ke orders table

        CartLapangan::where('user_id', Auth::id())->delete(); // Kosongkan cart setelah checkout

        return response()->json(['message' => 'Checkout successful', 'total' => $totalPrice]);
    }
}
