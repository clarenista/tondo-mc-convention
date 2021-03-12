<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booth;

class BoothController extends Controller
{

    public function get()
    {

        return Booth::get();
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
