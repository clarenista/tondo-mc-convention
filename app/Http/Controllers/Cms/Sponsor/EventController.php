<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    public function index()
    {

        $category = request()->user()->booth->eventCategory()->with(['events' => function ($q) {
            $q->select('user_event_category_id', 'label', DB::raw('count(user_id) as count'))->groupBy('label');
        }])->first();
        return view("cms.sponsor.event.index", compact('category'));
    }
}
