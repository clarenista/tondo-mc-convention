<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{

    public function index()
    {

        $questionnaires = Questionnaire::all();

        return view('cms.questionnaire.index', compact('questionnaires'));
    }

    public function create()
    {

        $questionnaire = new Questionnaire;

        return view('cms.questionnaire.form', compact('questionnaire'));
    }

    public function store(Request $request)
    {

        Questionnaire::create($request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'nullable|in:quiz',
        ]));

        return redirect()->route('cms.questionnaires.index');

    }

    public function edit(Questionnaire $questionnaire)
    {

        return view('cms.questionnaire.form', compact('questionnaire'));
    }

    public function update(Request $request, Questionnaire $questionnaire)
    {

        $questionnaire->update($request->validate([
            'name' => 'required|string',
            'instruction' => 'nullable|string',
            'ending_message' => 'nullable|string',
            'description' => 'nullable|string',
            'category' => 'nullable|in:quiz',
        ]));

        return redirect()->route('cms.questionnaires.index');
    }

    public function quickUpdate(Request $request, Questionnaire $questionnaire)
    {

        $questionnaire->update($request->validate([
            'instruction' => 'nullable|string',
            'ending_message' => 'nullable|string',
        ]));

        return redirect()->route('cms.questions.index', 'questionnaire_id=' . $questionnaire->id);
    }

    public function destroy(Questionnaire $questionnaire)
    {

        $questionnaire->delete();

        return \redirect()->route('cms.questionnaires.index')
            ->with('success', 'You have successfully deleted the questionnaire.');
    }
}
