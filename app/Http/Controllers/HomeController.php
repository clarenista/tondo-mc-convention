<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("home.index");
    }

    public function registration(){
        return view("home.registration");
    }

    public function storeRegistration(Request $request){
        return response()->json([
            'status' => 'ok',
            'postdata' => $request->all()

        ]);
    }
    
    public function gallery(){
        return view("home.gallery");
    }

    public function login(Request $request){
        return response()->json([
            'status' => 'ok',
            'postdata' => $request->all()

        ]);
    }    

}
