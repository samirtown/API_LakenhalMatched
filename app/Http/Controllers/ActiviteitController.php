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
        return Activiteit::join('users', 'activiteit.user_ID', '=', 'users.user_ID')->get()->where('user_ID','=',$user_ID);
    }

    public function activiteitenGerapporteerd(){
        return Activiteit::where('aantal_gerapporteerd', '>', 5)->join('users', 'activiteit.user_ID', '=', 'users.user_ID')->get();
    }

    public function create(Request $request){
        $activiteit = new Activiteit();
        $activiteit->titel = $request->get('titel');
        $activiteit->beschrijving = $request->get('beschrijving');      
        $activiteit->user_ID = $request->get('user_ID');   
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
