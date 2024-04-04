<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/migrate', function () {
    Artisan::call('migrate');
    dd('migrated!');
});
Route::get('/dangerr', function () {
    Artisan::call('migrate:fresh');
    dd('dangerr!');
});

Route::get('/reboot', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    dd('All done!');
});

Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('pathMatch', ".*");
