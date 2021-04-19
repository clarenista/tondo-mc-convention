<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function get(){

        $event = Event::select('start_at')->first();
        $event->start_at_ = strtotime($event->start_at) * 1000;

        return $event;
    }
}
