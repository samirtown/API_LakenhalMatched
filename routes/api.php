<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ActiviteitController;
use App\Http\Controllers\GroepschatController;
use App\Http\Controllers\UserGroepschatController;
use App\Http\Controllers\InschrijvingenController;
use App\Http\Controllers\RapporteerActiviteitController;

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

//User routes
Route::get('/users/{user_ID}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'index']);

Route::put('users/update/{user_ID}', [UserController::class, 'update']);
Route::put('users/updateJSON/{user_ID}', [UserController::class, 'updateJSON']);

//Activiteit routes
Route::get('/activiteit/{activiteit_ID}', [ActiviteitController::class, 'show']);
Route::get('/activiteit', [ActiviteitController::class, 'index']);

//Categorie routes
Route::get('/categorie/{categorie}', [CategorieController::class, 'show']);
Route::get('/categorie', [CategorieController::class, 'index']);
Route::post('/categorie/create', [CategorieController::class, 'create']);
Route::put('/categorie/delete/{categorie_ID}', [CategorieController::class, 'delete']);

//Groepschat routes
Route::get('/groepschat/{groepschat_ID}', [GroepschatController::class, 'show']);
Route::get('/groepschat', [GroepschatController::class, 'index']);

//UserGroepschat routes
Route::get('/userGroepschat/{user_ID}', [UserGroepschatController::class, 'usersInGroep']);
Route::get('/userGroepschat/{groepschat_ID}', [UserGroepschatController::class, 'groepenVanUser']);

//Inschrijvingen routes 
Route::get('/inschrijvingen/{user_ID}', [InschrijvingenController::class, 'inschrijvingenPersoon']);
Route::get('/inschrijvingen/{activiteit_ID}', [InschrijvingenController::class, 'inschrijvingenActiviteit']);
Route::get('/inschrijvingen', [InschrijvingenController::class, 'index']);

//RapporteerActiviteit routes 
Route::get('/rapporteerActiviteit/{activiteit_ID}', [RapporteerActiviteitController::class, 'rapportagesActiviteit']);
Route::get('/rapporteerActiviteit', [RapporteerActiviteitController::class, 'index']);

//Authenticatie
Route::group(['prefix' => 'auth', 'middleware' => 'CORS'], function ($router) {
    Route::post('/register', [UserController::class, 'register'])->name('register.user');
    Route::post('/login', [UserController::class, 'login'])->name('login.user');
    Route::get('/view-profile', [UserController::class, 'viewProfile'])->name('profile.user');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
