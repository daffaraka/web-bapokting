<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaMonitoring extends Model
{
    protected $fillable = [
        'pasar_id',
        'jenis_komoditas_id',
        'user_id',
        'tanggal',
        'harga',
        'stok',
    ];

    // Define relationships

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    public function jenis_komoditas()
    {
        return $this->belongsTo(JenisKomoditas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
