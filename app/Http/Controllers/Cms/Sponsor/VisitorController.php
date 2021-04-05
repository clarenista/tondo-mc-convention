<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use Illuminate\Http\Request;

class VisitorController extends Controller
{

    public function index()
    {
        $category = request()->user()->booth->eventCategory()->with(['events' => function ($q) {
            $q->with('user')->distinct('user_id');
        }])->first();
        \Log::info($category);
        return view("cms.sponsor.visitor.index", compact('category'));
    }
}
