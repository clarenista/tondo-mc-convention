<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\QuestionAnswer;
use App\Models\UserEvent;
use App\Models\UserEventCategory;

class GuestController extends Controller
{

    public function boothTracker()
    {

        $booths = UserEventCategory::whereCategorizableType('App\Models\Booth')->get();

        $boothTracks = UserEvent::whereIn('user_event_category_id', $booths->pluck('id'))->get();

        dd($boothTracks);

        $return = [];

        foreach($booths as $booth){

            $return[$booth->id] = [
                'name' => $booth->name,
            ];

        }


        return $return;
    }
}
