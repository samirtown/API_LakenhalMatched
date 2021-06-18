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

    public function activiteitenUsersProfiel($user_ID){
        return Activiteit::join('users', 'activiteit.user_ID', '=', 'users.user_ID')->get()->where('user_ID','=',$user_ID);
    }

    public function activiteitenGerapporteerd(){
        return Activiteit::where('aantal_gerapporteerd', '>', 5)->join('users', 'activiteit.user_ID', '=', 'users.user_ID')->orderBy('activiteit.aantal_gerapporteerd', 'DESC')->get();
    }

    public function destroy($id){
        $activiteit = Activiteit::where('activiteit_ID', '=', $id)->delete();
        return response()->json('activiteit verwijderd');
    }

    public function updateRapportage($id){
        $activiteit = Activiteit::where('activiteit_ID', '=', $id)->update([
            "aantal_gerapporteerd" => 0
        ]);
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
