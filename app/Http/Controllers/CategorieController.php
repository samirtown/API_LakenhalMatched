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

    public function store(Request $request){
        $categorie = new Categorie();
        $categorie->categorie = $request->get('categorie');
        $categorie->lakenhal_activiteit = $request->get('lakenhal_activiteit');       
        $categorie->save();
        return $categorie;
    }

    public function delete($categorie_ID){
        $categorie = Categorie::where('categorie_ID',"=",$categorie_ID)->delete();
    }
}
