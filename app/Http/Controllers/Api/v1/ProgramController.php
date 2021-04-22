<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{

    public function get()
    {

        $event = Program::select('start_at', 'video_url', 'type', DB::raw('`group` as embedded'), 'enabled', 'title')->first();
        $event->start_at_ = strtotime($event->start_at) * 1000;

        return $event;
        return Program::first();
    }
}
