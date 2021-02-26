<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Spatie\Permission\Models\Role;


Route::get('test', function(){
    return "Success!";
});
