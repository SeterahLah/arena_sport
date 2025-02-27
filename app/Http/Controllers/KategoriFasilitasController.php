<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriFasilitas;

class KategoriFasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = KategoriFasilitas::all();
        return view('admin.kategori.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.kategori.fasilitas.tambah');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'required',
        ]);

        KategoriFasilitas::create([
            'id' => Str::uuid(),
            'nama' => $request->nama,
            'logo' => $request->logo,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Bank berhasil ditambahkan');
    }

    public function edit($id)
    {
        $fasilitas = KategoriFasilitas::findOrFail($id);
        return view('admin.kategori.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $bank = KategoriFasilitas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'required'
        ]);

        // Jika ada upload gambar baru

        $bank->nama = $request->nama;
        $bank->logo = $request->logo;
        $bank->save();

        return redirect()->route('fasilitas.index')->with('success', 'Kategori Bank  berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KategoriFasilitas::destroy($id);
        return redirect()->route('fasilitas.index');
    }

}
