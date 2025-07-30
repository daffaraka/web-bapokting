<?php

namespace App\Models;

use App\Models\UPTD;
use App\Models\HargaMonitoring;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    protected $fillable = ['nama', 'lokasi', 'uptd_id'];

    public function uptd()
    {
        return $this->belongsTo(UPTD::class);
    }

    public function hargaMonitorings()
    {
        return $this->hasMany(HargaMonitoring::class);
    }
}
