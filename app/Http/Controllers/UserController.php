<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($user_ID){
        return user::where('user_ID','=',$user_ID)->first();
    }
    
    public function index(){
        return User::get();
    }
}
