<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{

    public function update()
    {
        $input = request()->merge([
            'enabled' => filter_var(request()->enabled, FILTER_VALIDATE_BOOLEAN),
        ])->validate([
            'program_id' => 'required',
            'enabled' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'unique_id' => 'required',  //Zoom ID
            'title' => 'nullable',  //Topic
            'description' => 'required', //Token
        ]);

        DB::statement('UPDATE programs SET enabled = 0');

        $event = Program::find($input['program_id']);
        if ($event) {
            $event->update($input);
        } else {
            Program::create($input);
        }

        return redirect()->route('cms.event-management.index');
    }
}
