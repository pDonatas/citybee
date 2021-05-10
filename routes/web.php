<?php

use App\Http\Controllers\Admin\AdminController;
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
Route::get('/admin', [App\Http\Controllers\MainController::class, 'showAdmin'])->name("admin");
Route::get('/admin/cars', [App\Http\Controllers\CarsController::class, 'showAllCarsForAdmin']);
Route::get('/admin/cars/new', [App\Http\Controllers\CarsController::class, 'showAddCar']);
Route::get('/admin/cars/{id}', [App\Http\Controllers\CarsController::class, 'showEditCar']);
Route::post('addCar', [App\Http\Controllers\CarsController::class, 'addCar']);
Route::post('editCar/{id}', [App\Http\Controllers\CarsController::class, 'editCar']);
Route::post('deleteCars', [App\Http\Controllers\CarsController::class, 'deleteCars']);
//Contact info
Route::get('/contact_info', [App\Http\Controllers\UsersController::class, 'showPersonalData'])->name('contact_info');
Route::get('/edit_contact_info/{id}', [App\Http\Controllers\UsersController::class, 'showClientPersonalData']);
Route::post('edit', [App\Http\Controllers\UsersController::class, 'updateData']);
//Wallet
Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'openWallet']);
Route::get('/add_money_to_wallet', [App\Http\Controllers\WalletController::class, 'addMoney']);
Route::post('addMoney', [App\Http\Controllers\WalletController::class, 'updateBalance']);
//Trips history
Route::get('/trips_history', [App\Http\Controllers\RentController::class, 'showTripsHistory']);
//Car Rent
Route::get('/available_cars', [App\Http\Controllers\CarsController::class, 'showAvailableCars'])->name('available_cars');
Route::get('/reserve_car/{id}', [App\Http\Controllers\RentController::class, 'showRentWindow']);
Route::get('/rent_car/{id}', [App\Http\Controllers\RentController::class, 'startRent']);
Route::get('/end_rent/{id}', [App\Http\Controllers\RentController::class, 'endRent']);


//Customer success specialist
Route::resource('/help', CustomerSuccessSpecialistController::class);
Route::post('/help/write/{id}', [CustomerSuccessSpecialistController::class, 'write'])->name('help.write');
Route::get('/help/chats', [CustomerSuccessSpecialistController::class, 'showChats'])->name('help.chats');
Route::get('/help/accept/{id}', [CustomerSuccessSpecialistController::class, 'accept'])->name('help.accept');
Route::get('/help/chat/{id}', [CustomerSuccessSpecialistController::class, 'chat'])->name('help.chat');
Route::get('/help/car/connect/{id}', [AdminController::class, 'showCarControls'])->name('help.car.connect');
Route::get('/help/car/technical/{id}', [AdminController::class, 'technical'])->name('help.car.technical');
Route::get('/help/discount/{id}', [AdminController::class, 'showDiscounts'])->name('help.discount');
Route::post('/help/discount/{id}', [AdminController::class, 'submitDiscount'])->name('help.submit.discount');
//Car
Route::get('/lock/{id}', [AdminController::class, 'lockCar'])->name('lock');
