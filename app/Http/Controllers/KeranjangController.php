<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\TransaksiProduk;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keranjang = Keranjang::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('produk')
            ->get();

        return view('keranjang', compact('keranjang','user'));
    }

    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $produk = $keranjang->produk;

        $keranjang->jumlah = $request->jumlah;
        $keranjang->subtotal = $request->jumlah * $produk->harga;
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk diperbarui!');
    }
    public function tambahKeKeranjang(Request $request, $produk_id)
    {
        $user = Auth::user();
        $produk = Produk::findOrFail($produk_id);

        // Cek apakah produk sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', $user->id)
            ->where('produk_id', $produk_id)
            ->where('status', 'pending')
            ->first();

        if ($keranjang) {
            // Jika sudah ada, tambahkan jumlah
            $keranjang->jumlah += 1;
            $keranjang->subtotal = $keranjang->jumlah * $produk->harga;
            $keranjang->save();
        } else {
            // Jika belum ada, buat item baru
            Keranjang::create([
                'user_id' => $user->id,
                'produk_id' => $produk_id,
                'jumlah' => 1,
                'subtotal' => $produk->harga,
                'status' => 'pending'
            ]);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    // Fungsi untuk menampilkan isi keranjang user
    // public function tampilKeranjang()
    // {
    //     $user = Auth::user();
    //     $keranjang = Keranjang::where('user_id', $user->id)
    //         ->where('status', 'pending')
    //         ->with('produk')
    //         ->get();

    //     return response()->json($keranjang);
    // }

    // Fungsi untuk menghapus item dari keranjang
    public function hapus($id)
    {
        $keranjang = Keranjang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk diperbarui!');
    }
}
