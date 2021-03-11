<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $assets = Asset::all();

        return view("cms.assets.list", compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $asset = new Asset;

        return view("cms.assets.form", \compact('asset'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
        }

        Asset::create(
            $request->merge([
                'url' => Storage::url($request->type . "/" . $file_name),
            ])->validate([
                'name' => 'required|string',
                'type' => 'required|string',
                'category' => 'required|string',
                'url' => 'required|string',
            ])
        );

        if ($request->hasFile('file')) {

            $file->storeAs("{$request->type}/", $file_name);
        }

        return \redirect()->route('cms.assets.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {

        return view("cms.assets.form", \compact('asset'));
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

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
        }

        $asset->update(
            $request->merge([
                'url' => Storage::url($request->type . "/" . $file_name),
            ])->validate([
                'name' => 'required|string',
                'type' => 'required|string',
                'category' => 'required|string',
                'url' => 'required|string',
            ])
        );

        if ($request->hasFile('file')) {

            $file->storeAs("{$request->type}/", $file_name);
        }

        return \redirect()->route('cms.assets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {

        $asset->delete();

        return \response([
            'message' => 'deleted.',
        ]);
    }
}
