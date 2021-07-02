<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroepschat;
use Illuminate\Support\Facades\DB;

class UserGroepschatController extends Controller
{
    //Zie welke users er allemaal in een groepschat zitten
    public function usersEnGroep(){
        return UserGroepschat::all();
    }
    
    //Zie welke users er allemaal in een groepschat zitten
    public function usersInGroep($user_ID){
        return UserGroepschat::where('user_ID','=',$user_ID)->get();
    }
    //Zie in welke groepen een user allemaal zit
    public function groepenVanUser($groepschat_ID){
        return UserGroepschat::where('groepschat_ID','=',$groepschat_ID)->get();
    }

    //Zie welke users er allemaal in een groepschat zitten met de activiteit informatie
    public function usersInGroepActiviteit($user_ID){
        return UserGroepschat::where('user_groepschat.user_ID','=',$user_ID)
        ->join('groepschat', 'user_groepschat.groepschat_ID', '=', 'groepschat.groepschat_ID')
        ->join('activiteit', 'groepschat.groepschat_ID', '=', 'activiteit.activiteit_ID')
        ->get();
    }
}
