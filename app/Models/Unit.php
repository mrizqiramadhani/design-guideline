<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel (plural form)
    protected $table = 'units';

    // Menentukan atribut yang dapat diisi secara mass-assignment
    protected $fillable = [
        'name',
    ];
}
