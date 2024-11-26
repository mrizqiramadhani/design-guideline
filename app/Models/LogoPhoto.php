<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoPhoto extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan plural nama model
    protected $table = 'logo_photos';

    // Tentukan atribut yang bisa diisi
    protected $fillable = [
        'logo_id',
        'path',
        'theme'
    ];

    // Relasi: LogoPhoto dimiliki oleh satu logo
    public function logo()
    {
        return $this->belongsTo(Logo::class);
    }
}
