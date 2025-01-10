<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'security_question',
        'security_answer',
        'validated_at',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
