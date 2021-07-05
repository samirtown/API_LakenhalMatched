<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activiteit;
use App\Models\GroepsChat;
use App\Models\UserGroepschat;
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
        return Activiteit::join('users', 'activiteit.user_ID', '=', 'users.user_ID')->where('users.user_ID','=',$user_ID)->get();
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
        $activiteit->categorie = $request->get('categorie');     

        if($request->file('afbeelding')){
            $uniqueid = uniqid();
            $extension = $request->file('afbeelding')->getClientOriginalExtension();
            $afbeelding_name = $uniqueid.'.'.$extension;
            $afbeelding_path = $request->file('afbeelding')->storeAs('', $afbeelding_name, 'profiel_foto' );
            $activiteit->afbeelding = $afbeelding_path;
        }

        $activiteit->save();

        $groepChat = new GroepsChat();
        $groepChat->groepschat_ID = $activiteit->activiteit_ID;
        $groepChat->groeps_aantal = 0;
        $groepChat->max_aantal_personen = $activiteit->max_aantal_deelnemers;
        $groepChat->activiteit_ID = $activiteit->activiteit_ID;
        $groepChat->save();

        $chat = new UserGroepschat();
        $chat->user_ID = $request->get('user_ID');
        $chat->groepschat_ID = $activiteit->activiteit_ID;
        $chat->save();

        return $chat;
    }
}
