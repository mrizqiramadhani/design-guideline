<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iconography extends Model
{
    use HasFactory;

    protected $table = 'iconography';

    protected $fillable = [
        'path',
        'unit_id',
        'user_id'
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
