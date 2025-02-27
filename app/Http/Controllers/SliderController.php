<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }
    public function showSliders()
    {
        $sliders = Slider::all();

        return view('beranda', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'pilihan' => 'required|in:Belanja Sekarang,Booking Sekarang,Kunjungi Sekarang',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('sliders', 'public');

        Slider::create([
            'nama' => $request->nama,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'url' => $request->url,
            'pilihan' => $request->pilihan,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    public function show(Slider $slider)
    {
        return view('sliders.show', compact('slider'));
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }


    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'pilihan' => 'required|in:Belanja Sekarang,Booking Sekarang,Kunjungi Sekarang',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($slider->gambar) {
                \Storage::delete('public/' . $slider->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('slider_images', 'public');
            $slider->gambar = $gambarPath;
        }

        $slider->nama = $request->nama;
        $slider->deskripsi_singkat = $request->deskripsi_singkat;
        $slider->url = $request->url;
        $slider->pilihan = $request->pilihan;
        $slider->save();

        return redirect()->route('sliders.index')->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->gambar);
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider berhasil dihapus.');
    }
}
