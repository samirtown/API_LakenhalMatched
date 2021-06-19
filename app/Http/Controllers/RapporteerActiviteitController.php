<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapporteerActiviteit;
use App\Models\Activiteit;

class RapporteerActiviteitController extends Controller
{
    //Zie Alle rapportages van een activiteit
    public function rapportagesActiviteit($activiteit_ID){
        return RapporteerActiviteit::where('activiteit_ID','=',$activiteit_ID)->get();
    }
    
    public function index(){
        return RapporteerActiviteit::all();
    } 

    public function addRapportage(Request $request){
        $thisActiviteit = $request->get('activiteit_ID');
        $thisUser = $request->get('user_ID');
        $aantalgerapporteerd = Activiteit::where('activiteit_ID', '=', $thisActiviteit)->select('aantal_gerapporteerd')->get();
        $userRapportage = RapporteerActiviteit::where('user_ID','=',$thisUser)->where('activiteit_ID', '=', $thisActiviteit)->get();
        if($userRapportage->isEmpty()){
            error_log('hier');
            $rapporteerActiviteit = new RapporteerActiviteit();
            $rapporteerActiviteit->activiteit_ID = $request->get('activiteit_ID');
            $rapporteerActiviteit->user_ID = $request->get('user_ID');
            $rapporteerActiviteit->save();
            $activiteit = Activiteit::where('activiteit_ID', '=', $thisActiviteit)->update([
                  "aantal_gerapporteerd" => ($aantalgerapporteerd[0]['aantal_gerapporteerd'] + 1)
            ]);
            return $rapporteerActiviteit;
        }else{
            return response('hallotjes', 200)
            ->header('Content-Type', 'text/plain');
        }
    }
}
