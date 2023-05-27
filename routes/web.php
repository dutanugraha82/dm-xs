<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
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

Route::get('/login', [LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);
Route::get('/register',[LoginController::class,'register'])->middleware('guest');
Route::post('/register',[LoginController::class,'registing'])->middleware('guest');

Route::middleware(['user','auth','revalidate'])->group(function(){
    Route::get('/dashboard', function(){
        return view('user.contents.dashboard');
    });
    Route::get('/profile/{id}', [ProfileController::class,'index']);
    Route::post('/profile/{id}',[ProfileController::class,'store']);
    Route::put('/profile/{id}',[ProfileController::class,'update']);
});

Route::middleware(['superadmin','auth','revalidate'])->prefix('superadmin')->name('superadmin.')->group(function(){
    Route::get('/', function(){
        return view('superadmin.master');
    });
});

