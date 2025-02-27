<?php

namespace App\Models;

use App\Models\Lapangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriFasilitas extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kategori_fasilitas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nama', 'logo'];

    public function lapangan()
    {
        return $this->hasMany(Lapangan::class, 'id_fasilitas');
    }

}
