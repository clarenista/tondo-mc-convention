<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class ApiTokenController extends Controller
{
    /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function update($user)
    {
        $token = Str::random(80);
        $user = User::findOrFail($user->id);
        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return $token;
    }
}