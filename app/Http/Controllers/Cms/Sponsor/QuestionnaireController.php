<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\QuestionAnswer;
use App\Models\Questionnaire;
use App\Models\User;
use App\Traits\SpreadsheetTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{

    use SpreadsheetTrait;

    public function index()
    {

        $questionnaire = request()->user()->booth->questionnaire()->with('questions')->first();
        $answers = QuestionAnswer::select('id', 'user_id', 'question_id', DB::raw("sum(correct) as score"))->whereIn('question_id', $questionnaire->questions->pluck('id'))->with('user')->groupBy('user_id')->get();

        return view("cms.sponsor.questionnaire.index", compact('answers'));
    }

    public function exportToSpreadsheet()
    {

        $questionnaire = request()->user()->booth->questionnaire()->with('questions')->first();
        $guests = User::with('answers')->whereHas('answers', function ($q) use ($questionnaire) {
            $q->whereIn('question_id', $questionnaire->questions->pluck('id'));
        })->get();
        $headers = [
            'First Name', 'Last Name', 'Mobile Number', 'Email Address', 'Affiliation', 'Classification',
        ];
        $headers = array_merge($headers, $questionnaire->questions->pluck('question')->toArray());
        $this->newSpreadsheet(auth()->user()->name . " - Quizzes", 'Quizzes', $headers);
        $i = 2;
        foreach ($guests as $guest) {
            $columns = [
                $guest->first_name,
                $guest->last_name,
                $guest->mobile_number,
                $guest->email_address,
                $guest->affiliation,
                $guest->classification,
            ];
            foreach ($guest->answers as $answer) {
                $columns[] = $answer->answer;
            }
            $this->setRows(
                $columns,
                $i++
            );
        }

        return response()->download($this->saveSpreadsheet());
    }
}
