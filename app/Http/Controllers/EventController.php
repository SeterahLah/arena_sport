<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create() {
        return view('admin.events.tambah');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'by' => 'required|string|max:255',
            'url' => 'required|url',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('gambar')->store('events', 'public');

        Event::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'by' => $request->by,
            'url' => $request->url,
            'gambar' => $path,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show($id) {
        $event = Event::findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    public function edit($id) {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'by' => 'required|string|max:255',
            'url' => 'required|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::findOrFail($id);
        $path = $event->gambar;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('events', 'public');
        }

        $event->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'by' => $request->by,
            'url' => $request->url,
            'gambar' => $path,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy($id) {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus!');
    }
}