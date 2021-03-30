<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\BoothHotspot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoothController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $booths = Booth::all();

        return view('cms.booth.list', compact('booths'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $booth = new Booth;
        $sponsors = User::doesntHave('booth')->role('sponsor')->get();
        return view("cms.booth.form", \compact('booth', 'sponsors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::transaction(function () {

            $booth = Booth::create(
                \request()->validate([
                    'user_id' => 'required',
                    'name' => 'required|string',
                    'caption' => 'nullable|string',
                    'url' => 'nullable|string',
                    'pitch' => 'required',
                    'yaw' => 'required',
                    'panorama_location' => 'required',
                ])
            );

            $this->uploadFile($booth->assets()->create([
                'type' => 'Booth',
                'category' => 'background',
            ]), 'background');

            $this->uploadFile($booth->assets()->create([
                'type' => 'Booth',
                'category' => 'booth',
            ]), 'booth');

            $hotspot = $booth->hotspots()->create([
                'name' => 'External Link',
                'x' => 0,
                'y' => 0,
            ]);

            $asset = $hotspot->assets()->create([
                'name' => 'Website',
                'url' => 'http://localhost',
                'type' => 'Booth',
                'category' => 'external-link',
            ]);

            $hotspot->assets()->attach($asset);

            $hotspot = $booth->hotspots()->create([
                'name' => 'Contact Us Link',
                'x' => 0,
                'y' => 0,
            ]);

            $asset = $hotspot->assets()->create([
                'name' => 'Contact Us',
                'url' => 'http://localhost',
                'type' => 'Booth',
                'category' => 'contact-us',
            ]);

            $hotspot->assets()->attach($asset);
        });

        return \redirect()->route('cms.booths.index')
            ->with('success', 'You have successfully added a Booth.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booth  $booth
     * @return \Illuminate\Http\Response
     */
    public function edit(Booth $booth)
    {

        $booth->load('hotspots', 'user');
        $sponsors = User::doesntHave('booth')->role('sponsor')->get();

        return view("cms.booth.form", \compact('booth', 'sponsors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booth  $booth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booth $booth)
    {

        DB::transaction(function () use ($booth) {
            $booth->update(
                \request()->validate([
                    'name' => 'required|string',
                    'caption' => 'nullable|string',
                    'url' => 'nullable|string',
                    'pitch' => 'required',
                    'yaw' => 'required',
                    'panorama_location' => 'required',
                ])
            );
            foreach (\request()->hotspots as $hotspot_id => $hotspot) {
                $booth->hotspots()->whereId($hotspot_id)->update($hotspot);
            }
            $this->uploadFile($booth->assets()
                    ->whereType('Booth')
                    ->whereCategory('background')
                    ->first(), 'background');
            $this->uploadFile($booth->assets()
                    ->whereType('Booth')
                    ->whereCategory('booth')
                    ->first(), 'booth');
        });

        return \redirect()->route('cms.booths.index')
            ->with('success', 'You have successfully added a Booth.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booth  $booth
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booth $booth)
    {

        $booth->delete();
        $booths = Booth::all();

        return view('cms.booth.list', compact('booths'))->with('success', 'You have successfully deleted the booth.');
    }

    public function storeHotspot(Request $request, $id)
    {
        $booth = Booth::find($id);
        $hotspot = $booth->hotspots()->create([
            'name' => $request->hotspot_name,
            'x' => $request->hotspot_x,
            'y' => $request->hotspot_y,
        ]);
        $sponsors = User::doesntHave('booth')->role('sponsor')->get();

        return view("cms.booth.form", \compact('booth', 'sponsors'));
    }

    public function destroyHotspot(Request $request, $id)
    {
        $hotspot_id = BoothHotspot::find($id);
        $hotspot_id->delete();
    }
}
