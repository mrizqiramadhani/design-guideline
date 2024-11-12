<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan plural nama model
    protected $table = 'logos';

    // Tentukan atribut yang bisa diisi
    protected $fillable = [
        'title',
        'thumbnail',
        'unit_id',
        'user_id'
    ];

    // Relasi: Satu logo memiliki banyak logo_photo
    public function logoPhotos()
    {
        return $this->hasMany(LogoPhoto::class);
    }

    // Relasi: Satu logo dimiliki oleh satu unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Relasi: Satu logo dimiliki oleh satu user (admin/operator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
