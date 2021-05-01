<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerSuccessSpecialists\CustomerSuccessSpecialistController;
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

Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'openWallet']);
Route::get('/add_money_to_wallet', [App\Http\Controllers\WalletController::class, 'addMoney']);
Route::post('addMoney', [App\Http\Controllers\WalletController::class, 'updateBalance']);


//Customer success specialist
Route::resource('/help', CustomerSuccessSpecialistController::class);
Route::post('/help/write/{id}', [CustomerSuccessSpecialistController::class, 'write'])->name('help.write');
Route::get('/help/chats', [CustomerSuccessSpecialistController::class, 'showChats'])->name('help.chats');
Route::get('/help/accept/{id}', [CustomerSuccessSpecialistController::class, 'accept'])->name('help.accept');
Route::get('/help/chat/{id}', [CustomerSuccessSpecialistController::class, 'chat'])->name('help.chat');
Route::get('/help/car/connect/{id}', [CustomerSuccessSpecialistController::class, 'connect'])->name('help.car.connect');
Route::get('/help/car/technical/{id}', [CustomerSuccessSpecialistController::class, 'technical'])->name('help.car.technical');
Route::get('/help/discount/{id}', [CustomerSuccessSpecialistController::class, 'discount'])->name('help.discount');
Route::get('/help/ban/{id}', [CustomerSuccessSpecialistController::class, 'ban'])->name('help.ban');
