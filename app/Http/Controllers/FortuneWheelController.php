<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booth;

class FortuneWheelController extends Controller
{
    function index($id, $user_id){
        $booth = Booth::find($id);
        if ($booth->wheel) {
            $segments = $booth->wheel->segments;
            return view('fortuneWheel', compact('segments'));
        }
        return response([
            'success' => false,
        ]);
    }
}
