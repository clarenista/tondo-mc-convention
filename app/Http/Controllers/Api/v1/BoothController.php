<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\QuestionAnswer;

class BoothController extends Controller
{

    public function get()
    {

        return Booth::with('assets')->get();
    }

    public function show($booth_id)
    {

        $booth = Booth::whereId($booth_id)
            ->with(['assets', 'hotspots', 'hotspots.assets'])
            ->first();

        $return = [
            'id' => $booth->id,
            'name' => $booth->name,
            'panorama_location' => $booth->panorama_location,
        ];

        foreach ($booth->assets as $asset) {
            $return[$asset->category] = $asset->url;
        }

        foreach ($booth->hotspots as $hotspot) {
            $return['hotspots'][$hotspot->name] = $hotspot;
        }

        return $return;

    }

    public function storeMessage($booth_id)
    {

        return request()
            ->user()
            ->boothMessages()
            ->create(
                \request()->merge([
                    'booth_id' => $booth_id,
                ])->validate([
                    'booth_id' => 'required',
                    'subject' => 'nullable',
                    'name' => 'nullable',
                    'affiliation' => 'nullable',
                    'mobile_number' => 'nullable',
                    'email' => 'nullable',
                    'interest' => 'nullable',
                    'message' => 'nullable',
                ])
            );
    }

    public function showQuestionnaire($booth_id)
    {

        $booth = Booth::find($booth_id);

        return $booth->questionnaire()->with('questions')->first();
    }

    public function storeQuestionnaireAnswerSubmit($booth_id)
    {

        $sent_at = date("Y-m-d H:i:s");

        request()->validate([
            'answers' => 'required'
        ]);

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
