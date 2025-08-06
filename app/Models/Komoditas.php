<?php

namespace App\Models;

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

}
