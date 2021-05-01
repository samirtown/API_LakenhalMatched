<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RapporteerActiviteit;

class RapporteerActiviteitController extends Controller
{
    //Zie Alle rapportages van een activiteit
    public function rapportagesActiviteit($activiteit_ID){
        return RapporteerActiviteit::where('activiteit_ID','=',$activiteit_ID)->get();
    }
    
    public function index(){
        return RapporteerActiviteit::all();
    } 
}
