<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{

    public function get()
    {

        $event = Program::select('start_at', 'video_url', 'type', DB::raw('`group` as embedded'), 'enabled', 'title')->whereEnabled(1)->where('id','<',5)->first();

        if(!$event){
            $event = Program::select('start_at', 'video_url', 'type', DB::raw('`group` as embedded'), 'enabled', 'title')->where(1)->first();

        }
        // $event->start_at_ = strtotime($event->start_at) * 1000;

        return $event;
    }

    public function bm()
    {

        $event = Program::select('start_at', 'video_url', 'type', DB::raw('`group` as embedded'), 'enabled', 'title')->whereId(5)->first();
        $event->start_at_ = strtotime($event->start_at) * 1000;

        return $event;
    }

    public function rh()
    {

        $event = Program::select('start_at', 'video_url', 'type', DB::raw('`group` as embedded'), 'enabled', 'title')->whereId(6)->first();
        $event->start_at_ = strtotime($event->start_at) * 1000;

        return $event;
    }

}
