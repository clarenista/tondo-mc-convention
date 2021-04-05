<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'questionnaire_id',
        'question',
        'choices',
        'answer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        "choices" => 'array',
    ];

    public function questionnaire()
    {

        return $this->belongsTo(Questionnaire::class);
    }

    public function answers()
    {

        return $this->hasMany(QuestionAnswer::class);
    }
}
