<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'campaigns';

    // Kolom yang dapat diisi mass-assignment
    protected $fillable = [
        'path',
        'status',
        'unit_id',
        'user_id',
    ];

    /**
     * Relasi dengan model Unit
     * Campaign dimiliki oleh satu unit
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi dengan model User
     * Campaign dibuat oleh seorang user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
