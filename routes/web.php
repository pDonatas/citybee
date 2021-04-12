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
Route::get('/contact_info', [App\Http\Controllers\UsersController::class, 'showContactInfo'])->name('contact_info');
Route::get('/edit_contact_info/{id}', [App\Http\Controllers\UsersController::class, 'editContactInfo']);
Route::post('edit', [App\Http\Controllers\UsersController::class, 'updateContactInfo']);
Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'openWallet']);
Route::get('/add_money_to_wallet', [App\Http\Controllers\WalletController::class, 'addMoney']);
Route::post('addMoney', [App\Http\Controllers\WalletController::class, 'updateBalance']);
