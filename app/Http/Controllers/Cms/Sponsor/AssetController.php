<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\BoothHotspot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{

    public function index()
    {

        $this->validateHotspotId();

        $assets = Asset::whereHas('hotspots', function ($q) {
            $q->whereBoothHotspotId(\request()->hotspot_id);
        })->get();
        $hotspot = BoothHotspot::find(\request()->hotspot_id);

        if ($hotspot->name == "wheels") {

            return (new WheelController)->index();
        }

        return view("cms.sponsor.asset.index", compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->validateHotspotId();

        $hotspot = BoothHotspot::find(\request()->hotspot_id);

        $asset = new Asset;

        return view("cms.sponsor.asset.form", \compact('asset', 'hotspot'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validateHotspotId();

        DB::transaction(function () {
            $hotspot = BoothHotspot::find(\request()->hotspot_id);
            $asset = Asset::create(
                request()->validate([
                    'name' => 'required|string',
                    'url' => 'nullable',
                    'thumbnail_url' => 'nullable',
                    'type' => 'nullable',
                    'category' => 'nullable',
                ])
            );
            $hotspot->assets()->attach($asset);
            if (in_array($hotspot->name, ['brochures', 'gallery'])) {
                $this->uploadFile($asset, 'url', 'url');
            }
            $this->uploadFile($asset, 'thumbnail_url', 'thumbnail_url');
        });

        return \redirect()->route('cms.sponsor.assets.index', ['hotspot_id' => \request()->hotspot_id])
            ->with('success', 'You have successfully uploaded the file.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {

        $hotspot = BoothHotspot::find(\request()->hotspot_id);

        return view("cms.sponsor.asset.form", \compact('asset', 'hotspot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {

        DB::transaction(function () use ($asset) {
            $hotspot = BoothHotspot::find(\request()->hotspot_id);
            $asset->update(
                $input = request()->validate([
                    'name' => 'required|string',
                    'url' => 'nullable',
                    'thumbnail_url' => 'nullable',
                    'type' => 'nullable',
                    'category' => 'nullable',
                ])
            );
            // $hotspot->assets()->attach($asset);
            if (in_array($hotspot->name, ['brochures', 'gallery'])) {
                $this->uploadFile($asset, 'url', 'url');
            }
            $this->uploadFile($asset, 'thumbnail_url', 'thumbnail_url');
        });

        return \redirect()->route('cms.sponsor.assets.index', ['hotspot_id' => \request()->hotspot_id])
            ->with('success', 'You have successfully updated the file.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {

        $this->validateHotspotId();

        DB::transaction(function () use ($asset) {
            $hotspot = BoothHotspot::find(\request()->hotspot_id);
            $hotspot->assets()->detach($asset);
            $asset->delete();
        });

        return \redirect()->route('cms.sponsor.assets.index', ['hotspot_id' => \request()->hotspot_id])
            ->with('success', 'You have successfully deleted the file.');
    }

    private function validateHotspotId()
    {

        \request()->validate([
            'hotspot_id' => 'in:' . auth()->user()->booth->hotspots()->pluck('id')->implode(","),
        ]);
    }
}
