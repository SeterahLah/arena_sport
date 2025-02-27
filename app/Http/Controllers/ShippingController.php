<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    // Get List Provinsi
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . '/province');

        return response()->json($response->json());
    }

    // Get List Kota Berdasarkan Provinsi
    public function getCities($province_id)
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . "/city?province=$province_id");

        return response()->json($response->json());
    }

    // Get Shipping Cost
    public function getShippingCost(Request $request)
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->post(env('RAJAONGKIR_BASE_URL') . '/cost', [
            'origin' => 501, // ID kota asal pengiriman (contoh: Yogyakarta)
            'destination' => $request->destination,
            'weight' => 1000, // Berat dalam gram (ubah sesuai kebutuhan)
            'courier' => $request->courier
        ]);

        return response()->json($response->json());
    }
}
