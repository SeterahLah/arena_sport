<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = Info::latest()->paginate(10);
        return view('admin.info.index', compact('infos'));
    }

    public function showInfos()
    {
        $infos = Info::all();

        return view('info', compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.info.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'alamat' => 'required|string|max:255',
            'by' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('info_images', 'public');
        }

        Info::create([
            'id' => Str::uuid(),
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'by' => $request->by,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('info.index')->with('success', 'Informasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Info $info)
    // {
    //     return view('detail_info', compact('info'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = Info::findOrFail($id);
        return view('admin.info.edit', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $info = Info::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'by' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($info->gambar) {
                \Storage::delete('public/' . $info->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('info_images', 'public');
            $info->gambar = $gambarPath;
        }

        $info->nama = $request->nama;
        $info->deskripsi = $request->deskripsi;
        $info->alamat = $request->alamat;
        $info->by = $request->by;
        $info->save();

        return redirect()->route('info.index')->with('success', 'Informasi berhasil diperbarui!');
    }

    public function destroy(Info $info)
    {
        if ($info->gambar) {
            Storage::disk('public')->delete($info->gambar);
        }
        $info->delete();

        return redirect()->route('info.index')->with('success', 'Infomasi berhasil dihapus');
    }
}
