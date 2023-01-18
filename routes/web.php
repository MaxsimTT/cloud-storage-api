<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\FilesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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

    Route::post('/usersettoken', function (Request $request) {
        if ($request->user()->tokens->first()) {
            return redirect()->route('user_profile');
        }

        $request->user()->createToken('user_token');
        return redirect()->route('user_profile');
    })->name('usersettoken');

    Route::post('/usergeltoken', function (Request $request) {
        if ($request->user()->tokens->first()) {
            $request->user()->tokens()->delete();
            return redirect()->route('user_profile');
        }
        return redirect()->route('user_profile');
    })->name('usergeltoken');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
