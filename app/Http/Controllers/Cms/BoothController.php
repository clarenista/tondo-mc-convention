<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\BoothHotspot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        DB::transaction(function () use ($request) {

            $booth = Booth::create(
                $request->validate([
                    'user_id' => 'required',
                    'name' => 'required|string',
                    'caption' => 'nullable|string',
                    'url' => 'nullable|string',
                    'pitch' => 'required',
                    'yaw' => 'required',
                    'panorama_location' => 'required',
                    'type' => 'required',
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

            $booth->questionnaire()->create([
                'name' => $booth->name . " Quiz",
                'description' => $booth->name . " Quiz",
                'category' => "Quiz",
            ]);
            $booth->eventCategory()->create([
                'name' => Str::slug($booth->name),
                'description' => $booth->name,
            ]);

            if ($booth['type'] = 'gold') {
                $hotpots = [
                    ['External Link', 55, 16, 'https://localhost'],
                    ['Contact Us', 69, 10, ''],
                    ['Quiz', 60, 82, ''],
                    ['Brochures', 69, 19, ''],
                    ['Videos', 42, 72, ''],
                    ['Gallery', 47, 38, ''],
                ];
            }

            if ($booth['type'] = 'silver') {
                $hotpots = [
                    ['External Link', 55, 16, 'https://localhost'],
                    ['Contact Us', 69, 10, ''],
                    ['Quiz', 60, 82, ''],
                    ['Brochures', 69, 19, ''],
                    ['Videos', 42, 72, ''],
                    ['Gallery', 47, 38, ''],
                ];
            }

            if ($booth['type'] = 'bronze') {
                $hotpots = [
                    ['External Link', 55, 16, 'https://localhost'],
                    ['Contact Us', 69, 10, ''],
                    ['Quiz', 60, 82, ''],
                    ['Brochures', 69, 19, ''],
                    ['Videos', 42, 72, ''],
                    ['Gallery', 47, 38, ''],
                ];
            }

            foreach ($hotpots as $hotpot) {
                $booth->hotspots()->create([
                    'name' => Str::slug($hotpot[0]),
                    'caption' => $hotpot[0],
                    'x' => $hotpot[1],
                    'y' => $hotpot[2],
                ])->assets()->create([
                    'name' => $hotpot[0],
                    'url' => $hotpot[3],
                    'type' => 'Booth',
                    'category' => Str::slug($hotpot[0]),
                ]);
            }
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
                    'type' => 'required',
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
            $booth->eventCategory()->update([
                'name' => Str::slug($booth->name),
                'description' => $booth->name,
            ]);
        });

        return \redirect()->route('cms.booths.index')
            ->with('success', 'You have successfully updated a Booth.');
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
