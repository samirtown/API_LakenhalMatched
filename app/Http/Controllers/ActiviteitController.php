<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activiteit;
use Illuminate\Support\Facades\DB;

class ActiviteitController extends Controller
{ 
    public function show($activiteit_ID){
        return Activiteit::where('activiteit_ID','=',$activiteit_ID)->first();
    }
    
    public function index(){
        return Activiteit::all();
    }
    
    public function activiteitenUsers(){
        return Activiteit::join('users', 'activiteit.user_ID', '=', 'users.user_ID')->get();
    }

    public function activiteitenGerapporteerd(){
        return Activiteit::where('aantal_gerapporteerd', '>', 5)->join('users', 'activiteit.user_ID', '=', 'users.user_ID')->orderBy('activiteit.aantal_gerapporteerd', 'DESC')->get();
    }

    public function create(Request $request){
        $activiteit = new Activiteit();
        $activiteit->titel = $request->get('titel');
        $activiteit->beschrijving = $request->get('beschrijving');      
        $activiteit->user_ID = $request->get('user_ID');   
        $activiteit->save();
        return $activiteit;
    }
}
