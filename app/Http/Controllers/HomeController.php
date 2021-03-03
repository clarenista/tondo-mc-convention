<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    public function index(){
        return view("home.index");
    }

    public function registration(){
        return view("home.registration");
    }

    public function storeRegistration(Request $request){
        $user = User::create($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'status' => 'ok',
            'postdata' => $request->all()

        ]);
    }
    
    public function gallery(){
        return view("home.gallery");
    }

    public function login(Request $request){
        
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $token = ApiTokenController::update($user);
                return response()->json([
                    'status' => 'ok',
                    'user' => $user,
                    'permissions' => $user->getPermissionsViaRoles()->pluck('name'),
                    'api_token' => $token
                ]);
            }
        }else{
            
            return response()->json([
                'status' => 'failed',
            ]);
        }
        // if(Hash::check($request->password, $user->password)){
        // }
    }    

}
