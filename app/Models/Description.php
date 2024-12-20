<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Description extends Model
{
    use HasFactory;

    protected $table = 'descriptions';


    protected $fillable = [
        'title',
        'content',
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
