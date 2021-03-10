<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function loginView(){
        return view('cms.login');
    }

    public function loginUser(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/cms');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logoutUser(){
        $logout = Auth::logout();
        return redirect()->route('login');
    }

    public function storeRegistration(Request $request){
        // $request->api_token = null;
        $user = User::create($request->except('api_token'));
        $user->password = Hash::make($request->password);
        $user->save();
        if($request->role == 'admin'){
            $admin = Role::where('name', 'admin')->first();
            $user->assignRole($admin);
            
        }else{
            $sponsor = Role::where('name', 'sponsor')->first();
            $user->assignRole($sponsor);

        }
        // $user = User::with('permissions')->with('roles')->get();
        // $user->givePermissionTo('booth manager');
        // create permissions
        // Permission::create(['name' => 'manage booth']);
        
        // create roles and assign existing permissions
        // $role1 = Role::create(['name' => 'sponsor']);
        // $role1->givePermissionTo('manage booth');
        
        // $user = User::find(1);
        return response()->json([
            'status' => 'ok',
            'postdata' => $user
            

        ]);
    }

    public function allUsers(){
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        // // create permissions
        // // Permission::create(['name' => 'manage booth']);
        
        // // create roles and assign existing permissions
        // // $role1 = Role::create(['name' => 'sponsor']);
        // $role1 = Role::where('name', 'admin')->first();
        // // $role1->givePermissionTo('manage booth');
        
        // $user = User::find(1);
        // $user->assignRole($role1);
        $users = User::all();
        foreach ($users as $key => $value) {
            $users[$key]->permissions = $value->getPermissionsViaRoles()->pluck('name');
        }
        // return $users;
        return response()->json([
            'users' => $users
        ]);
    }
}
