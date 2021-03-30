<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExternalLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $assets = Asset::where('type', '=', 'external_link')
            ->where('user_id', $user_id)
            ->get();
        return view('cms.external_link.list', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $asset = new Asset;
        return view('cms.external_link.form', \compact('asset'));
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
            $asset = Asset::create(
                request()->validate([
                    'user_id' => 'required',
                    'name' => 'required|string',
                    'type' => 'required|string',
                    'category' => 'nullable|string',
                    'url' => 'required|string',
                ])
            );
            \Log::info($asset);
            auth()->user()->booth->assets()->syncWithoutDetaching($asset);
            // $this->uploadFile($asset);
        });

        return \redirect()->route('cms.sponsor.links.index')
            ->with('success', 'You have successfully added an External Link.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $asset = \request()->user()->booth->hotspots()->whereName('external-link')->first()->assets()->first();

        return view('cms.external_link.form', \compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $asset = \request()->user()->booth->hotspots()->whereName('external-link')->first()->assets()->first();

        $asset_id = $asset->update([
            'name' => $request['name'],
            'url' => $request['url'],
        ]);

        return \redirect()->route('cms.sponsor.links.index')
            ->with('success', 'You have successfully updated the file.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset_id = Asset::find($id);
        $asset_id->delete();
    }
}
