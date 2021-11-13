<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Booth;
use App\Models\BoothHotspot;
use App\Models\BoothWheel;
use App\Traits\SpreadsheetTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WheelController extends Controller
{


    public function index()
    {
        $booth = auth()->user()->booth;
        $wheel = $booth->wheel ?? new BoothWheel;
        return view('cms.sponsor.wheel.index', compact('wheel'));
    }

    public function store()
    {

        $booth = auth()->user()->booth;
        $wheel = $booth->wheel;
        $segments = [];
        foreach (\request()->text as $i => $text) {
            $text = trim($text);
            if (!$text) continue;
            $segments[] = [
                'fillStyle' => \request()->fillStyle[$i],
                'text' => $text,
                'size' => \request()->size[$i],
            ];
        }
        if ($wheel) {
            $wheel->update(['segments' => $segments]);
        } else {
            $booth->wheel()->create(['segments' => $segments]);
            $hotspot = BoothHotspot::find(\request()->hotspot_id);
            $asset = Asset::create(
                [
                    'name' => 'Wheel of Fortune',
                    'url' => "/api/v1/booths/{$booth->id}/wheel",
                    'thumbnail_url' => 'nullable',
                    'type' => 'Booth',
                    'category' => 'wheel',
                ]
            );
            $hotspot->assets()->attach($asset);
        }
        return redirect()->back();
    }    

    public function update()
    {

        $booth = auth()->user()->booth;
        $wheel = $booth->wheel;
        $segments = [];
        foreach (\request()->text as $i => $text) {
            $text = trim($text);
            if (!$text) continue;
            $segments[] = [
                'fillStyle' => \request()->fillStyle[$i],
                'text' => $text,
                'size' => \request()->size[$i],
            ];
        }
        if ($wheel) {
            $wheel->update(['segments' => $segments]);
        } else {
            $booth->wheel()->create(['segments' => $segments]);
            $hotspot = BoothHotspot::find(\request()->hotspot_id);
            $asset = Asset::create(
                [
                    'name' => 'Wheel of Fortune',
                    'url' => "/api/v1/booths/{$booth->id}/wheel",
                    'thumbnail_url' => 'nullable',
                    'type' => 'Booth',
                    'category' => 'wheel',
                ]
            );
            $hotspot->assets()->attach($asset);
        }
        return redirect()->back();
    }
}
