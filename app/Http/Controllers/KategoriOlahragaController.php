<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriOlahraga;

class KategoriOlahragaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriOlahraga::all();
        return view('admin.kategori.olahraga.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.olahraga.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'id' => Str::uuid(),
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('bank_images', 'public');
        }

        KategoriOlahraga::create([
            'id' => Str::uuid(),
            'nama' => $request->nama,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('olahraga.index')->with('success', 'Olahraga berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriOlahraga::findOrFail($id);
        return view('admin.kategori.olahraga.edit', compact('kategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $olahraga = KategoriOlahraga::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($olahraga->gambar) {
                Storage::delete('public/' . $olahraga->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('bank_images', 'public');
            $olahraga->gambar = $gambarPath;
        }

        $olahraga->nama = $request->nama;
        $olahraga->save();

        return redirect()->route('olahraga.index')->with('success', 'Kategori Olahraga  berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        KategoriOlahraga::destroy($id);
        return redirect()->route('olahraga.index');
    }

}
