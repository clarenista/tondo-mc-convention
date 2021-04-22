<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\User;
use App\Models\UserEvent;
use App\Traits\SpreadsheetTrait;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    use SpreadsheetTrait;

    public function index()
    {
        $category = request()->user()->booth->eventCategory()->with(['events' => function ($q) {
            $q->with('user')->whereLabel('visit')->groupBy('user_id');
        }])->first();

        return view("cms.sponsor.visitor.index", compact('category'));
    }

    public function exportToSpreadsheet()
    {

        $this->newSpreadsheet(auth()->user()->name . " - Visitors", 'Visitors', [
            'First Name', 'Last Name', 'Mobile Number', 'Email Address', 'Affiliation', 'Classification',
        ]);
        $i = 2;
        foreach (UserEvent::with('user')->whereLabel('visit')->groupBy('user_id')->get() as $visitor) {
            $this->setRows(
                [
                    $visitor->user->first_name,
                    $visitor->user->last_name,
                    $visitor->user->mobile_number,
                    $visitor->user->email_address,
                    $visitor->user->affiliation,
                    $visitor->user->classification,
                ],
                $i++
            );
        }

        return response()->download($this->saveSpreadsheet());
    }
}
