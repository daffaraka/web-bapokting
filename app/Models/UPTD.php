<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pasar;
use Illuminate\Database\Eloquent\Model;

class UPTD extends Model
{

    protected $table = 'uptds';
    protected $fillable = [
        'nama',
        // 'alamat'
    ];

    public function pasars()
    {
        return $this->hasMany(Pasar::class, 'uptd_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
