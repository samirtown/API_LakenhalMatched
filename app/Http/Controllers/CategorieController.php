<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;

class CategorieController extends Controller
{
    public function show($categorie){
        return Categorie::where('categorie','=',$categorie)->first();
    }
    
      public function index(){
        return Categorie::all();
    } 
}
