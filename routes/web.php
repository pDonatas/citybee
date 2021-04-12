<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\MainController::class, 'showProfile'])->name('profile');
Route::get('/contact_info', [App\Http\Controllers\UsersController::class, 'showPersonalData'])->name('contact_info');
Route::get('/edit_contact_info/{id}', [App\Http\Controllers\UsersController::class, 'showClientPersonalData']);
Route::post('edit',[App\Http\Controllers\UsersController::class,'updateData']);
