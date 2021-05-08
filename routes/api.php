<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CustomerSuccessSpecialists\CustomerSuccessSpecialistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/refresh/{id}', [CustomerSuccessSpecialistController::class, 'refresh']);
Route::post('/updateCarData', [AdminController::class, 'updateCarData']);
Route::post('/banUser', [AdminController::class, 'banUser']);
