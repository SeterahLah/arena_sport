<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\KategoriBank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $bank = Bank::all();
        return view('admin.bank.index', compact('bank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriBank::all();
        return view('admin.bank.tambah',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'rekening' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            
        ]);
        Bank::create([
            'nama' => $request->nama,
            'rekening' => $request->rekening,
            'bank' => $request->bank,
            
        ]);

        return redirect()->route('bank.index')->with('success', 'Bank berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bank = Bank::findOrFail($id);
        return view('kategori_bank.show', compact('kategoribank'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = Bank::findOrFail($id);
        return view('admin.bank.edit', compact('kategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);

        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
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

        return redirect()->route('bank.index')->with('success', 'Kategori Bank  berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Bank::destroy($id);
        return redirect()->route('bank.index');
    }
}
