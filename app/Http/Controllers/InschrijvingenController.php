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
}
