<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activiteit;

class ActiviteitController extends Controller
{ 
    public function show($activiteit_ID){
        return Activiteit::where('activiteit_ID','=',$activiteit_ID)->first();
    }
    
    public function index(){
        return Activiteit::all();
    } 

    public function create(Request $request){
        $activiteit = new Activiteit();
        $activiteit->titel = $request->get('titel');
        $activiteit->beschrijving = $request->get('beschrijving');
        $activiteit->user_ID = $request->get('user_ID'); 
        $activiteit->lakenhal_activiteit = $request->get('lakenhal_activiteit');
        $activiteit->max_aantal_deelnemers = $request->get('max_aantal_deelnemers');        
        $activiteit->save();
        return $activiteit;
    }
}
