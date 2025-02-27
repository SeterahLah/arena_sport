<?php

namespace App\Http\Controllers;

use App\Models\KategoriFasilitas;
use App\Models\KategoriOlahraga;
use App\Models\Lapangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $lapangan = Lapangan::where('user_id', Auth::id())->get(); // Hanya produk milik user yang login
    return view('admin.lapangan.index', compact('lapangan'));
    }

    public function create() {
        $fasilitas = KategoriFasilitas::all();
        $olahraga = KategoriOlahraga::all();
        return view('admin.lapangan.tambah', compact('fasilitas', 'olahraga'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'id_kategori' => 'required',
            'fasilitas' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif,Stok Habis',
            'waktu' => 'required',
            'tanggal' => 'required',
            'alamat' => 'required|string|max:255',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id_fasilitas = [];
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produk', 'public');
                $gambarPaths[] = $path;
            }
        }

        Lapangan::create([
            'id' => Str::uuid(),
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'id_kategori' => $request->id_kategori,
            'fasilitas' => json_encode($request->fasilitas, JSON_UNESCAPED_SLASHES),
            'status' => $request->status,
            'alamat' => $request->alamat,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
            'user_id' => Auth::id(), 
            'gambar' => json_encode($gambarPaths),
        ]);

        return redirect()->route('lapangan.index')->with('success', 'lapangan berhasil ditambahkan');
    }

    public function edit($id) {
        $lapangan = Lapangan::findOrFail($id);
        $olahraga = KategoriOlahraga::all();
        $fasilitas = KategoriFasilitas::all();
        return view('admin.lapangan.edit', compact('lapangan', 'olahraga', 'fasilitas'));
    }

    public function update(Request $request, $id) {
        $produk = Lapangan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'id_kategori' => 'required',
            'fasilitas' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif,Stok Habis',
            'waktu' => 'required',
            'tanggal' => 'required',
            'alamat' => 'required|string|max:255',
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
            'id_kategori' => $request->id_kategori,
            'fasilitas' => json_encode($request->fasilitas, JSON_UNESCAPED_SLASHES),
            'status' => $request->status,
            'alamat' => $request->alamat,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
            'user_id' => Auth::id(), 
            'gambar' => json_encode(array_values($gambarPaths))
        ]);

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil diperbarui');
    }

    public function destroy($id) {
        $produk = Lapangan::findOrFail($id);

        // Hapus gambar dari storage
        $gambarPaths = json_decode($produk->gambar, true);
        if ($gambarPaths) {
            foreach ($gambarPaths as $path) {
                Storage::disk('public')->delete($path); 
            }
        }

        $produk->delete();
        return redirect()->route('lapangan.index')->with('success', 'Produk berhasil dihapus');
    }
}
