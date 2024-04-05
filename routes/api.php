<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaysoffController;
use App\Http\Controllers\MaxPlaceController;
use App\Http\Controllers\ReservationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('edit_profil','edit_profil');
    Route::post('login_admin','login_admin');
    Route::get('get_auth_user','get_auth_user');
});

Route::controller(ReservationController::class)->group(function(){

    Route::post('save_reservation','save_reservation'); 
    Route::get('get_reamining_seats/{date}/{hours}','get_reamining_seats'); 
    Route::get('get_reservations','get_reservations'); 
  
});
Route::controller(DaysoffController::class)->group(function(){

    Route::post('save_day_off','save_day_off'); 

    Route::get('get_days_off','get_days_off'); 
    
    Route::get('delete_daysoff/{id}','delete_daysoff'); 
  
});
Route::controller(MaxPlaceController::class)->group(function(){

     Route::post('edit_max_place/{id}','edit_max_place'); 
    
    Route::get('get_max_place/{id}','get_max_place'); 

    Route::get('get_max_places','get_max_places'); 
  
});