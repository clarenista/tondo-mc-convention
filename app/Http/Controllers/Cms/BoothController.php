<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Booth;
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
                    'x' => 'required',
                    'y' => 'required',
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
                    'x' => 'required',
                    'y' => 'required',
                ])
            );
            foreach(\request()->hotspots as $hotspot_id => $hotspot){
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

        return \redirect()->route('cms.booth.index')
            ->with('success', 'You have successfully deleted the booth.');
    }
}
