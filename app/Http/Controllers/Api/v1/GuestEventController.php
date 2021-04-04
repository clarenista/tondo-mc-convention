<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\UserEventCategory;
use Illuminate\Support\Str;

class GuestEventController extends Controller
{

    public function push()
    {
        // dd(\request()->user());
        $input = \request()->validate([
            'type' => 'in:ping,event',
            'category' => 'required',
            'label' => 'string',
        ]);

        $category = UserEventCategory::firstOrCreate([
            'name' => Str::slug($input['category']),
        ], [
            'description' => $input['category'],
        ]);

        $input['user_event_category_id'] = $category->id;
        $input['sent_at'] = date('Y-m-d H:i:s');

        request()->user()->events()->create($input);

        return \response(null, 201);
    }
}
