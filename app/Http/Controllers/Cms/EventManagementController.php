<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Program;
use Illuminate\Http\Request;

class EventManagementController extends Controller
{

    public function index(){

        $event = Event::first();
        $program = Program::first();

        return view('cms.event-management.index', compact('event', 'program'));
    }
}
