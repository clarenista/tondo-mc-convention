<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiTokenController;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index(){
        return view("cms.home");
    }

    public function registration(){
        return view("home.registration");
    }



    public function gallery(){
        return view("home.gallery");
    }

    public function login(Request $request){
        $guzzle = new \GuzzleHttp\Client;

        $token = $guzzle->post(config('app.domain').'/oauth/token', [
            'form_params' => [
                'grant_type' => config('app.passport.grant_type'),
                'client_id' => config('app.passport.client_id'),
                'client_secret' => config('app.passport.client_secret'),
                'scope' => '*',
            ],
        ]);
        // return json_decode((string) $token->getBody(), true)['access_token'];

        $response = $guzzle->post(config('app.domain').'/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.json_decode((string) $token->getBody(), true)['access_token'],
            ],
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ],
        ]);
        $result =json_decode((string) $response->getBody(), true);
        if($result){

            $user = User::firstOrCreate(
                [
                    'registrant_id' => $result['user']['id']
                ],
                [
                    'registrant_id' => $result['user']['id'],
                    'api_token' => hash('sha256', Str::random(80)),
                    'name' => $result['user']['first_name'] ." ". $result['user']['last_name'],
                    'first_name' => $result['user']['first_name'],
                    'last_name' => $result['user']['last_name'],
                    'mobile_number' => $result['user']['contact'],
                    'email' => $result['user']['username'],
                    'password' => $result['user']['password'],
                ]

            );
            return response()->json([
                'status' => 'ok',
                'user' => $user,
                'access_token' => $user->api_token
            ]);
        }else{
            return response()->json([
                'status' => 'failed',
            ]);
        }

        // $user = User::where('email', $request->email)->first();
        // if($user){
        //     if(Hash::check($request->password, $user->password)){
        //         $token = ApiTokenController::update($user);
        //         return response()->json([
        //             'status' => 'ok',
        //             'user' => $user,
        //             'permissions' => $user->getPermissionsViaRoles()->pluck('name'),
        //             'api_token' => $token
        //         ]);
        //     }
        // }else{

        //     return response()->json([
        //         'status' => 'failed',
        //     ]);
        // }
        // if(Hash::check($request->password, $user->password)){
        // }
    }

}
