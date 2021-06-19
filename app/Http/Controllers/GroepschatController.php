<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groepschat;

class GroepschatController extends Controller
{
    public function show($groepschat_ID){
        return Groepschat::where('groepschat_ID','=',$groepschat_ID)->first();
    }
    
      public function index(){
        return Groepschat::all();
    } 
}
