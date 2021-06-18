<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inschrijvingen;

class InschrijvingenController extends Controller
{
    //Zie alle inschrijvingen die een persoon heeft gedaan.
    public function inschrijvingenPersoon($user_ID){
        return Inschrijvingen::where('user_ID','=',$user_ID)->get();
    }
    //Zie alle inschrijvingen die bij een activiteit staan.
    public function inschrijvingenActiviteit($activiteit_ID){
        return Inschrijvingen::where('activiteit_ID','=',$activiteit_ID)->get();
    }  
    //Zie alle inschrijvingen met de user informatie
    public function inschrijvingenActiviteitUser($activiteit_ID){
        return Inschrijvingen::join('users', 'inschrijvingen.user_ID', '=', 'users.user_ID')->get()->where('activiteit_ID','=',$activiteit_ID);
    }  

    public function index(){
        return Inschrijvingen::all();
    } 

    public function create(Request $request){
        $activiteit = new Inschrijvingen();
        $activiteit->bericht = $request->get('bericht');
        $activiteit->user_ID = $request->get('user_ID');      
        $activiteit->activiteit_ID = $request->get('activiteit_ID');   
        $activiteit->save();
        return $activiteit;
    } 

    public function update($activiteit_ID, $user_ID){
        $inschrijving = Inschrijvingen::where('activiteit_ID','=',$activiteit_ID)->where('user_ID','=',$user_ID)->first();
        $inschrijving->geaccepteerd = true;
        $inschrijving->save();
        return $inschrijving;
    }

    public function ingeschreven($activiteit_ID, $user_ID){
        $ingeschreven = Inschrijvingen::where('activiteit_ID','=',$activiteit_ID)->where('user_ID','=',$user_ID)->first();
        if($ingeschreven){
            return "true";
        }elseif(!$ingeschreven){
            return "false";
        }
    }
}
