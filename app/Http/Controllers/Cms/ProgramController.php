<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function update()
    {

        $input = request()->merge([
            'enabled' => filter_var(request()->enabled, FILTER_VALIDATE_BOOLEAN),
        ])->validate([
            'enabled' => 'required',
            'type' => 'required|in:all,private',
            'start_at' => 'required',
            'end_at' => 'required',
            'title' => 'nullable',
            'group' => 'required',
            'description' => 'nullable',
            'video_url' => 'nullable',
            'video_thumbnail_url' => 'nullable',
            'unique_id' => 'nullable',
            'unique_code' => 'nullable',
        ]);

        $event = Program::first();
        $event->update($input);

        return redirect()->route('cms.event-management.index');
    }
}
