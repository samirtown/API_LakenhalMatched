<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function show($categorie){
        return Categorie::where('categorie','=',$categorie)->first();
    }
    
    public function index(){
        return Categorie::all();
    } 

    public function create(Request $request){
        $categorie = new Categorie(['categorie' => $request->categorie]);        
        $categorie->save();
    }

    public function delete($categorie){
        $categorie = Categorie::where('categorie',"=",$categorie)->delete();
    }
}
