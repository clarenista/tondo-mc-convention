<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $input = request()->validate([
            'questionnaire_id' => 'nullable',
        ]);

        if ($user->role('sponsor')) {
            $input['questionnaire_id'] = $user->booth->questionnaire->id;
        }

        $questionnaire = Questionnaire::find($input['questionnaire_id']);
        $questions = $questionnaire->questions;

        return view('cms.questionnaire.question.index', compact('questions', 'questionnaire'));
    }

    public function create()
    {

        request()->validate([
            'questionnaire_id' => 'required',
        ]);

        $questionnaire_id = request()->questionnaire_id;
        $question = new Question();

        return view('cms.questionnaire.question.form', compact('question', 'questionnaire_id'));
    }

    public function store(Request $request)
    {

        $request->merge([
            'answer' => $request->answer,
            'choices' => array_filter((array_map(function ($value) {
                return trim($value);
            }, $request->choices))),
        ]);

        $input = $request->validate([
            'questionnaire_id' => 'required|exists:questionnaires,id',
            'question' => 'required|string',
            'answer' => ['required', function ($attribute, $value, $fail) use ($request) {
                $choices = [];
                foreach ($request->choices as $choice) {
                    $choices[] = strtolower($choice);
                }

                if (!in_array(strtolower($value), $choices)) {
                    $fail($attribute . ' should be in choices.');
                }

            }],
            'choices' => 'required',
        ]);

        Questionnaire::find($input['questionnaire_id'])->questions()->create($input);

        return redirect()
            ->route('cms.questions.index', 'questionnaire_id=' . $input['questionnaire_id']);
    }

    public function edit(Question $question)
    {

        $questionnaire_id = $question->questionnaire->id;

        return view('cms.questionnaire.question.form', compact('question', 'questionnaire_id'));
    }

    public function update(Request $request, Question $question)
    {

        $request->merge([
            'answer' => $request->answer,
            'choices' => array_filter((array_map(function ($value) {
                return trim($value);
            }, $request->choices))),
        ]);

        $input = $request->validate([
            'question' => 'required|string',
            'answer' => ['required', function ($attribute, $value, $fail) use ($request) {
                $choices = [];
                foreach ($request->choices as $choice) {
                    $choices[] = strtolower($choice);
                }

                if (!in_array(strtolower($value), $choices)) {
                    $fail($attribute . ' should be in choices.');
                }

            }],
            'choices' => 'required',
        ]);

        $question->update($input);

        return redirect()
            ->route('cms.questions.index', 'questionnaire_id=' . $question->questionnaire->id);
    }

    public function destroy(Question $question)
    {

        $question->delete();

        return \redirect()
            ->route('cms.questions.index', 'questionnaire_id=' . $question->questionnaire->id)
            ->with('success', 'You have successfully deleted the questionnaire.');
    }
}
