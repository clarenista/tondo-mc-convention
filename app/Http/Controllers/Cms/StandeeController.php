<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StandeeController extends Controller
{

    public function index()
    {

        $standees = Booth::whereIn('type', ['standee'])->get();

        return view('cms.standee.list', compact('standees'));
    }

    public function create()
    {

        $standee = new Booth;
        return view("cms.standee.form", \compact('standee'));
    }

    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {

            $booth = Booth::create(
                $request->merge([
                    'user_id' => 1,
                    'type' => 'standee',
                ])->validate([
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
            $this->uploadFile($booth, 'file', 'url');
        });

        return \redirect()->route('cms.standees.index')
            ->with('success', 'You have successfully added a Standee.');
    }

    public function edit(Booth $standee)
    {

        return view("cms.standee.form", \compact('standee'));
    }

    public function update(Request $request, Booth $standee)
    {
        DB::transaction(function () use ($standee) {
            $standee->update(
                \request()->merge([
                    'user_id' => 1,
                    'type' => 'standee',
                ])->validate([
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
            $this->uploadFile($standee, 'file', 'url');
        });

        return \redirect()->route('cms.standees.index')
            ->with('success', 'You have successfully updated a Standee.');
    }

    public function destroy(Booth $standee)
    {

        $standee->delete();
        $standees = Booth::whereIn('type', ['standee'])->get();

        return view('cms.standee.list', compact('standees'))->with('success', 'You have successfully deleted the Standee.');
    }
}
