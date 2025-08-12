<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKomoditas extends Model
{

    protected $table = 'jenis_komoditas';
    protected $fillable = [
        'nama_jenis',
        'harga',
        'satuan',

    ];


     public function komoditas()
    {
        return $this->belongsTo(Komoditas::class);
    }


    public function harga_monitorings()
    {
        return $this->hasMany(HargaMonitoring::class);
    }
}
