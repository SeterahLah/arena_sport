<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\KategoriBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoribank = KategoriBank::all();
        return view('admin.kategori.banks.index', compact('kategoribank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.banks.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('bank_images', 'public');
        }

        KategoriBank::create([
            'nama_bank' => $request->nama_bank,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('banks.index')->with('success', 'Bank berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $kategoribank = KategoriBank::findOrFail($id);
    //     return view('kategori_bank.show', compact('kategoribank'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriBank::findOrFail($id);
        return view('admin.kategori.banks.edit', compact('kategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bank = KategoriBank::findOrFail($id);

        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($bank->gambar) {
                \Storage::delete('public/' . $bank->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('bank_images', 'public');
            $bank->gambar = $gambarPath;
        }

        $bank->nama_bank = $request->nama_bank;
        $bank->save();

        return redirect()->route('banks.index')->with('success', 'Kategori Bank  berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        KategoriBank::destroy($id);
        return redirect()->route('banks.index');
    }
}
