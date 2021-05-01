<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inschrijvingen;

class InschrijvingenController extends Controller
{
    //Zie alle inschrijvingen die een persoon heeft gedaan.
    public function inschrijvingenPersoon($user_id){
        return Inschrijvingen::where('user_ID','=',$user_ID)->get();
    }
    //Zie alle inschrijvingen die bij een activiteit staan.
    public function inschrijvingenActiviteit($activiteit_ID){
        return Inschrijvingen::where('activiteit_ID','=',$activiteit_ID)->get();
    }  
      public function index(){
        return Inschrijvingen::all();
    } 
}
