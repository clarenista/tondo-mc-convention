<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booth;

class BoothMessageController extends Controller
{

    public function store(Booth $booth)
    {

        request()->user()->boothMessage()->create(\request()->merge([
            'booth_id' => $booth->id,
        ])->validate([
            'booth_id' => 'required',
            'subject' => 'required',
            'name' => 'required',
            'affiliation' => 'required',
            'moible_number' => 'required',
            'email' => 'required',
            'interest' => 'required',
            'message' => 'required',
        ]));
    }

    public function show($booth_id)
    {

        $booth = Booth::whereId($booth_id)
            ->with(['assets', 'hotspots', 'hotspots.assets'])
            ->first();

        $return = [
            'id' => $booth->id,
            'name' => $booth->name,
        ];

        foreach ($booth->assets as $asset) {
            $return[$asset->category] = $asset->url;
        }

        foreach ($booth->hotspots as $hotspot) {
            $return['hotspots'][$hotspot->name] = $hotspot;
        }

        return $return;

    }
}
