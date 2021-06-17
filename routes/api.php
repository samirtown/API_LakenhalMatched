<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ActiviteitController;
use App\Http\Controllers\ChatController;
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
Route::put('users/updateKenmerk/{user_ID}', [UserController::class, 'updateKenmerk']);
Route::put('users/deleteKenmerk/{user_ID}', [UserController::class, 'deleteKenmerk']);
Route::post('users/profielFotoUpload/{user_ID}', [UserController::class, 'profielFotoUpload']);

//Activiteit routes
Route::get('/activiteit/{activiteit_ID}', [ActiviteitController::class, 'show']);
Route::get('/activiteit', [ActiviteitController::class, 'index']);
Route::get('/activiteitenUsers', [ActiviteitController::class, 'activiteitenUsers']);
Route::get('/activiteitenUsersProfiel/{user_ID}', [ActiviteitController::class, 'activiteitenUsersProfiel']);
Route::get('/activiteitenGerapporteerd', [ActiviteitController::class, 'activiteitenGerapporteerd']);
Route::post('/activiteit', [ActiviteitController::class, 'create']);
Route::patch('/activiteit/verwijderRapportage/{activiteit_ID}', [ActiviteitController::class, 'updateRapportage']);
Route::delete('/activiteit/{activiteit_ID}', [ActiviteitController::class, 'destroy']);

//Categorie routes
Route::get('/categorie/{categorie}', [CategorieController::class, 'show']);
Route::get('/categorie', [CategorieController::class, 'index']);
Route::post('/categorie/store', [CategorieController::class, 'store']);
Route::delete('/categorie/delete/{categorie_ID}', [CategorieController::class, 'delete']);

//Groepschat routes
Route::get('/groepschat/{groepschat_ID}', [GroepschatController::class, 'show']);
Route::get('/groepschat', [GroepschatController::class, 'index']);

//UserGroepschat routes
Route::get('/userGroepschat/{user_ID}', [UserGroepschatController::class, 'usersInGroep']);
Route::get('/userGroepschat/{groepschat_ID}', [UserGroepschatController::class, 'groepenVanUser']);

//Inschrijvingen routes 
Route::get('/inschrijvingen/user/{user_ID}', [InschrijvingenController::class, 'inschrijvingenPersoon']);
Route::get('/inschrijvingen/activiteit/{activiteit_ID}', [InschrijvingenController::class, 'inschrijvingenActiviteit']);
Route::get('/inschrijvingen/activiteitUser/{activiteit_ID}', [InschrijvingenController::class, 'inschrijvingenActiviteitUser']);
Route::put('/inschrijvingen/activiteit/{activiteit_ID}/{user_ID}', [InschrijvingenController::class, 'update']);
Route::get('/inschrijvingen', [InschrijvingenController::class, 'index']);
Route::post('/inschrijvingen', [InschrijvingenController::class, 'create']);

//RapporteerActiviteit routes 
Route::get('/rapporteerActiviteit/{activiteit_ID}', [RapporteerActiviteitController::class, 'rapportagesActiviteit']);
Route::get('/rapporteerActiviteit', [RapporteerActiviteitController::class, 'index']);

//Authenticatie
Route::group(['prefix' => 'auth', 'middleware' => 'CORS'], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register.user');
    Route::post('/login', [AuthController::class, 'login'])->name('login.user');
    Route::get('/view-profile', [AuthController::class, 'viewProfile'])->name('profile.user');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.user');

    Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('password.request');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.reset');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('messages', [ChatController::class, 'message']);
