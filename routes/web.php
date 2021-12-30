<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes(['register' => false]);


Route::get('/twitch_login', [App\Http\Controllers\HomeController::class, 'twitchLogin']);
Route::get('/twitch_auth', [App\Http\Controllers\HomeController::class, 'twitchAuth']);


Route::get('/join_channel', [App\Http\Controllers\HomeController::class, 'join']);
Route::get('/part_channel', [App\Http\Controllers\HomeController::class, 'part']);



Route::get('/start_bot', function() {
    system('/sbin/start_bot');
});

Route::get('/stop_bot', function() {
    system('/sbin/stop_bot');
});