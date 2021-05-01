<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserGroepschat;

class UserGroepschatController extends Controller
{
    //Zie welke users er allemaal in een groepschat zitten
    public function usersInGroep($user_ID){
        return UserGroepschat::where('user_ID','=',$user_ID)->get();
    }
    //Zie in welke groepen een user allemaal zit
    public function groepenVanUser($groepschat_ID){
        return UserGroepschat::where('groepschat_ID','=',$groepschat_ID)->get();
    }
}
