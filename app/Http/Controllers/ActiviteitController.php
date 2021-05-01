<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activiteit;

class ActiviteitController extends Controller
{ 
    public function show($activiteit_ID){
        return Activiteit::where('activiteit_ID','=',$activiteit_ID)->first();
    }
    
    public function index(){
        return Activiteit::all();
    } 
}
