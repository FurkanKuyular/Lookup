<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [UserController::class, 'getUser']);
    Route::post('logout', [UserController::class, 'logout']);
});

Route::resource('person', PersonController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('address', AddressController::class)->only('index', 'store', 'update', 'destroy');
