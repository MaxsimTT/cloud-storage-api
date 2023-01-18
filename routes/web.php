<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\FilesController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/user', [UserController::class, 'show'])->name('user_profile')->middleware('auth');

Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/user', [UserController::class, 'show'])->name('user_profile');
    Route::post('/user', [UserController::class, 'update'])->name('user_profile_update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
