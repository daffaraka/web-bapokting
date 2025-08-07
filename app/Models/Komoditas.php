<?php

namespace App\Models;

use App\Models\HargaPasar;
use App\Models\HargaMonitoring;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{

    protected $table = 'komoditas';
    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'satuan'
    ];


    public function harga_pasars()
    {
        return $this->hasMany(HargaPasar::class);
    }


    public function harga_monitorings()
    {
        return $this->hasMany(HargaMonitoring::class);
    }

}
