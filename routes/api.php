<?php

use App\Http\Controllers\PassengerController;
use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/passengers/search', [PassengerController::class, 'search']);
    Route::post('/passengers', [PassengerController::class, 'store']);
    Route::get('/passengers', [PassengerController::class, 'index']);
    Route::get('/passengers/{passenger}', [PassengerController::class, 'show']);
    Route::put('/passengers/{passenger}', [PassengerController::class, 'update']);
    Route::delete('/passengers/{passenger}', [PassengerController::class, 'destroy']);
});
