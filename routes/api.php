<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;

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

//Authenticatie
Route::group(['prefix' => 'users', 'middleware' => 'CORS'], function ($router) {
    Route::post('/register', [UserController::class, 'register'])->name('register.user');
    Route::post('/login', [UserController::class, 'login'])->name('login.user');
    Route::get('/view-profile', [UserController::class, 'viewProfile'])->name('profile.user');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');
});

//Activiteit routes
Route::get('/activiteit/{activiteit_ID}', 'ActiviteitController@show');
Route::get('/activiteit', 'ActiviteitController@index');

//Categorie routes
Route::get('/categorie/{categorie}', [CategorieController::class, 'show']);
Route::get('/categorie', [CategorieController::class, 'index']);
Route::post('/categorie/create', [CategorieController::class, 'create']);
Route::put('/categorie/delete/{categorie_ID}', [CategorieController::class, 'delete']);

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
Route::get('/users/show/{user_ID}', [UserController::class, 'show']);
Route::get('/users/index', [UserController::class, 'index']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
