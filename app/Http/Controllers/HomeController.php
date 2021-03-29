<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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

        $token = $guzzle->post('http://localhost:90/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => '3',
                'client_secret' => 'ypUepPwgymTaZtt6mvdjAkoOHGjPcZTVvBaHUjBM',
                'scope' => '*',
            ],
        ]);
        // return json_decode((string) $token->getBody(), true)['access_token'];
        
        $response = $guzzle->post('http://localhost:90/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.json_decode((string) $token->getBody(), true)['access_token'],
            ],
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
        
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
