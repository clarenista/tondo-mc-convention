<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\QuestionAnswer;
use App\Models\Question;

class BoothController extends Controller
{

    public function get()
    {

        return Booth::with('assets')->get();
    }

    public function show($booth_id)
    {

        $booth = Booth::whereId($booth_id)
            ->with(['assets', 'hotspots', 'hotspots.assets', 'questionnaire', 'wheel', 'user'])
            ->first();

        $return = [
            'id' => $booth->id,
            'name' => $booth->name,
            'panorama_location' => $booth->panorama_location,
            'sponsor_id' => $booth->user->id
        ];

        foreach ($booth->assets as $asset) {
            $return[$asset->category] = $asset->url;
        }

        foreach ($booth->hotspots as $hotspot) {
            $return['hotspots'][$hotspot->name] = $hotspot;
            $return['hotspots'][$hotspot->name]['name'] = $hotspot->name;
            $return['hotspots'][$hotspot->name]['questionnaire'] = $booth->questionnaire;
            $return['hotspots'][$hotspot->name]['questions'] = $booth->questionnaire->questions()->with(['answers' => function ($q) {
                $q->whereUserId(\request()->user()->id)->groupBy('question_id');
            }])->get();
            $return['hotspots'][$hotspot->name]['quiz_taken'] = request()->user()->answers()->with('question')->whereQuestionnaireId($booth->questionnaire->id)->groupBy('question_id')->get();
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
                    'affiliation' => request()->user()->affiliation,
                    'mobile_number' => request()->user()->mobile_number,
                    'email' => request()->user()->email_address,
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
        $booth = Booth::find($booth_id);

        $sent_at = date("Y-m-d H:i:s");

        request()->validate([
            'answers' => 'required'
        ]);
        // dd(json_decode(request()->answers, true));
        foreach (json_decode(request()->answers) as $question_id => $answer) {
            $question = Question::find($question_id);
            QuestionAnswer::create([
                'user_id' => request()->user()->id,
                'question_id' => $question_id,
                'answer' => $answer,
                'correct' => $question['answer'] == $answer ? 1 : 0,
                'sent_at' => $sent_at,
                'questionnaire_id' => $question->questionnaire->id,
            ]);
        }

        $questions = $booth->questionnaire->questions()->with(['answers' => function ($q) {
            $q->whereUserId(\request()->user()->id)->groupBy('question_id');
        }])->get();
        $answers = request()->user()->answers()->with('question')->whereQuestionnaireId($booth->questionnaire->id)->groupBy('question_id')->get();

        return response(['answers' => $answers, 'questions' => $questions], 201);
    }

    public function wheel($booth_id)
    {

        $booth = Booth::find($booth_id);
        if ($booth->wheel) {
            return response([
                'success' => true,
                'data' => $booth->wheel->segments
            ]);
        }
        return response([
            'success' => false,
            'data' => [],
        ]);
    }

    public function wheelSubmit($booth_id)
    {

        $booth = Booth::find($booth_id);
        $wheel = $booth->wheel;

        $input = request()->validate([
            'value' => 'required',
        ]);

        $input['user_id'] =  request()->user()->id;
        $wheel->submits()->create($input);

        return response([
            'success' => true,
        ]);
    }
}
