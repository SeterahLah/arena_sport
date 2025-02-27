<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller {
    public function index() {
        $produks = Produk::all();
        return view('admin.produk.index', compact('produks'));
    }

    public function create() {
        return view('admin.produk.tambah');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required|in:Pakaian,Alat,Makanan Atau Kesehatan',
            'status' => 'required|in:Aktif,Tidak Aktif,Stok Habis',
            'stok' => 'required|integer',
            'berat' => 'required|integer',
            'alamat' => 'required|string|max:255',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produk', 'public');
                $gambarPaths[] = $path;
            }
        }

        Produk::create([
            'id' => Str::uuid(),
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'stok' => $request->stok,
            'berat' => $request->berat,
            'alamat' => $request->alamat,
            'gambar' => json_encode($gambarPaths),
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id) {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required|in:Pakaian,Alat,Makanan Atau Kesehatan',
            'status' => 'required|in:Aktif,Tidak Aktif,Stok Habis',
            'alamat' => 'required|string|max:255',
            'stok' => 'required|integer',
            'berat' => 'required|integer',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPaths = json_decode($produk->gambar, true) ?? [];
        if ($request->has('hapus_gambar')) {
            foreach ($request->hapus_gambar as $hapus) {
                if (($key = array_search($hapus, $gambarPaths)) !== false) {
                    \Storage::disk('public')->delete($hapus); // Hapus dari storage
                    unset($gambarPaths[$key]); // Hapus dari array
                }
            }
        }
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produk', 'public');
                $gambarPaths[] = $path;
            }
        }

        $produk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'stok' => $request->stok,
            'berat' => $request->berat,
            'alamat' => $request->alamat,
            'gambar' => json_encode(array_values($gambarPaths))
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id) {
        $produk = Produk::findOrFail($id);

        // Hapus gambar dari storage
        $gambarPaths = json_decode($produk->gambar, true);
        if ($gambarPaths) {
            foreach ($gambarPaths as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}