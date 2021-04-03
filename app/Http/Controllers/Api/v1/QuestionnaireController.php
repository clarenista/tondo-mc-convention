<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\QuestionAnswer;

class QuestionnaireController extends Controller
{

    public function show(Booth $booth)
    {

        return $booth->questionnaire()->with('questions')->first();
    }

    public function submitAnswer()
    {

        $sent_at = date("Y-m-d H:i:s");

        foreach (request()->answers as $question_id => $answer) {
            QuestionAnswer::create([
                'user_id' => request()->user()->id,
                'question_id' => $question_id,
                'answer' => $answer,
                'sent_at' => $sent_at,
            ]);
        }

        return response('', 201);
    }
}
