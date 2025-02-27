<?php

namespace App\Http\Controllers;

use App\Models\Marquee;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marquees = Marquee::all();
        return view('admin.marquee.index', compact('marquees'));
    }
    public function create() {
        return view('admin.marquee.tambah');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        Marquee::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('marquee.index')->with('success', 'Marquee berhasil ditambahkan!');
    }

    public function show($id) {
        $marquee = Marquee::findOrFail($id);
        return view('admin.marquee.show', compact('marquee'));
    }

    public function edit($id) {
        $marquee = Marquee::findOrFail($id);
        return view('admin.marquee.edit', compact('marquee'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $marquee = Marquee::findOrFail($id);
        $path = $marquee->gambar;

        $marquee->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('marquee.index')->with('success', 'Marquee berhasil diperbarui!');
    }

    public function destroy($id) {
        $marquee = Marquee::findOrFail($id);
        $marquee->delete();
        return redirect()->route('marquee.index')->with('success', 'marquee berhasil dihapus!');
    }
}
