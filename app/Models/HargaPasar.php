<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaPasar extends Model
{
    protected $fillable = ['pasar_id', 'harga_id'];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    public function harga()
    {
        return $this->belongsTo(HargaMonitoring::class);
    }
}
