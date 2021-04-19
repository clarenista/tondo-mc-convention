<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'instruction',
        'ending_message',
        'name',
        'description',
        'category',
    ];

    public function questionnaireable()
    {

        return $this->morphTo();
    }

    public function questions()
    {

        return $this->hasMany(Question::class);
    }

    public function answers()
    {

        return $this->hasMany(QuestionAnswer::class);
    }
}
