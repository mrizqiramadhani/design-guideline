<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typography extends Model
{
    use HasFactory;

    protected $table = 'typography';

    protected $fillable = [
        'font_name', // Menambahkan kolom font_name ke fillable
        'path',
        'unit_id',
        'user_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
