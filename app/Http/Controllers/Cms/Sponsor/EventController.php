<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Traits\SpreadsheetTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    use SpreadsheetTrait;

    public function index()
    {

        $category = request()->user()->booth->eventCategory()->with(['events' => function ($q) {
            $q->select('user_event_category_id', 'label', DB::raw('count(user_id) as count'))->groupBy('label');
        }])->first();
        return view("cms.sponsor.event.index", compact('category'));
    }

    public function exportToSpreadsheet()
    {

        $this->newSpreadsheet(auth()->user()->name . " - Activities", 'Activities', [
            'Event', 'Count',
        ]);
        $i = 2;
        $category = request()->user()->booth->eventCategory()->with(['events' => function ($q) {
            $q->select('user_event_category_id', 'label', DB::raw('count(user_id) as count'))->groupBy('label');
        }])->first();
        foreach ($category->events as $events) {
            $this->setRows(
                [
                    $events->label,
                    $events->count,
                ],
                $i++
            );
        }

        return response()->download($this->saveSpreadsheet());
    }
}
