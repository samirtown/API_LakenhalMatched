<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Activiteit routes
Route::get('/activiteit/{activiteit_ID}', 'ActiviteitController@show');
Route::get('/activiteit', 'ActiviteitController@index');

//Categorie routes
Route::get('/categorie/{categorie}', 'CategorieController@show');
Route::get('/categorie', 'CategorieController@index');

//Groepschat routes
Route::get('/groepschat/{groepschat_ID}', 'GroepschatController@show');
Route::get('/groepschat', 'GroepschatController@index');

//UserGroepschat routes
Route::get('/userGroepschat/{user_ID}', 'UserGroepschatController@usersInGroep');
Route::get('/userGroepschat/{groepschat_ID}', 'UserGroepschatController@groepenVanUser');

//Inschrijvingen routes 
Route::get('/inschrijvingen/{user_ID}', 'InschrijvingenController@inschrijvingenPersoon');
Route::get('/inschrijvingen/{activiteit_ID}', 'InschrijvingenController@inschrijvingenActiviteit');
Route::get('/inschrijvingen', 'InschrijvingenController@index');

//RapporteerActiviteit routes 
Route::get('/rapporteerActiviteit/{activiteit_ID}', 'RapporteerActiviteitController@rapportagesActiviteit');
Route::get('/rapporteerActiviteit', 'RapporteerActiviteitController@index');

//User routes
Route::get('/user/{user_ID}', 'UserController@show');
Route::get('/user', 'UserController@index');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
