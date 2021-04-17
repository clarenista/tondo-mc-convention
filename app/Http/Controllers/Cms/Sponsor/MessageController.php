<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    public function index()
    {

        $messages = request()->user()->booth->messages()->with('user')->get();

        return view("cms.sponsor.message.index", compact('messages'));
    }
    public function exportToSpreadsheet(){


    }
}
