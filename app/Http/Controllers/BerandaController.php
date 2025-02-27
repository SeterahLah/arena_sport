<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Produk;
use App\Models\Slider;
use App\Models\Marquee;
use App\Models\Produks;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use App\Models\KategoriOlahraga;

class BerandaController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $marquee = Marquee::all();
        $olahraga = KategoriOlahraga::all();
        $lapangan = Lapangan::limit(6)->get();
        $info = Info::limit(2)->get();
        $produks = Produk::where('status', 'Aktif')->get();
        $categories = ['Pakaian', 'Alat', 'Makan Atau Kesehatan'];

        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category] = Produk::where('kategori', $category)
                ->where('status', 'Aktif') // Hanya ambil produk yang aktif
                ->get();
        }
        return view('beranda', compact('sliders', 'info', 'categories', 'productsByCategory','produks', 'marquee', 'lapangan', 'olahraga'));
    }
    public function info()
    {
        $info = Info::latest()->paginate(10);
        return view('info', compact('info'));
    }

    public function show($id)
    {
        $info = Info::findOrFail($id);
        return view('detail_info', compact('info'));
    }
}
