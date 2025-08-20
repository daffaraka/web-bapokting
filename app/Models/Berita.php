<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{

    use HasFactory;

    protected $fillable = [
        'judul_berita',
        'slug_berita',
        'konten_berita',
        'gambar_berita',
        'user_id',
        'status_berita',
        'published_at',
    ];

    /**
     * Relasi ke User (Penulis Berita).
     * Satu berita hanya bisa ditulis oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
