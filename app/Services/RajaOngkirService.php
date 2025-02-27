<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.api_key');
        $this->baseUrl = config('services.rajaongkir.base_url');
    }

    // Ambil daftar kota
    public function getCities()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("$this->baseUrl/city");

        return $response->json();
    }

    // Hitung ongkir
    public function getShippingCost($origin, $destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post("$this->baseUrl/cost", [
            'origin'        => $origin,      // ID kota asal
            'destination'   => $destination, // ID kota tujuan
            'weight'        => $weight,      // Berat dalam gram
            'courier'       => $courier      // jne, pos, tiki
        ]);

        return $response->json();
    }
}