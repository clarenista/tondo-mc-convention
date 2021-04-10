<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function update(){


        $input = request()->validate([
            'start_at' => 'required',
            'end_at' => 'required',
            'title' => 'nullable',
            'description' => 'nullable',
            'video_url' => 'nullable',
            'video_thumbnail_url' => 'nullable',
        ]);

        $event = Program::first();
        $event->update($input);

        return redirect()->route('cms.event-management.index');
    }
}
