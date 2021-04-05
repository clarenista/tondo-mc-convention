<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\UserEvent;
use App\Models\UserEventCategory;

class GuestController extends Controller
{

    public function boothTracker()
    {

        $booths = UserEventCategory::whereCategorizableType('App\Models\Booth')->get();

        $boothTracks = UserEvent::whereIn('user_event_category_id', $booths->pluck('id'))->whereLabel('visit')->get();

        $return = [];

        foreach ($booths as $booth) {
            $return[$booth->id] = [
                'name' => $booth->name,
                'visited' => boolval($boothTracks->where('user_event_category_id', $booth->categorizable->id)->count()),
            ];
        }

        return $return;
    }
}
