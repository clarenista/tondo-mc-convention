<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function get()
    {

        $event = Event::select('start_at')->first();
        $event->start_at_ = strtotime($event->start_at) * 1000;

        return $event;
    }

    public function getEvaluationForm()
    {

        $event = Event::first();

        return [
            'success' => true,
            'data' => [
                'evaluation_enable' => filter_var($event->subtitle, FILTER_VALIDATE_BOOLEAN),
            ]
        ];
        return response([
            'success' => true,
            'data' => [
                'evaluation_enable' => filter_var($event->subtitle, FILTER_VALIDATE_BOOLEAN),
            ]
        ]);
    }

    public function getFacebookLink()
    {

        $event = Event::first();

        return response([
            'success' => true,
            'data' => [
                'facebook_url' => $event->description,
                'facebook_enable' => filter_var($event->title, FILTER_VALIDATE_BOOLEAN),
            ]
        ]);
    }
}
