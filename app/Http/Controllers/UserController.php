<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($user_ID){
        return user::where('user_ID','=',$user_ID)->first();
    }
    
    public function index(){
        return user::all();
    }
}
