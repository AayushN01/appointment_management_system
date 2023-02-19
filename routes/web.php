<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/',[UserController::class,'loginForm'])->name('login_form');
Route::post('/',[UserController::class,'login'])->name('user.login');

Route::get('/register',[UserController::class,'registerForm'])->name('register_form');
Route::post('/register',[UserController::class,'register'])->name('user.register');

Route::get('/logout',[UserController::class,'logout'])->name('logout');

Route::get('/home',[UserController::class,'home'])->name('home');

