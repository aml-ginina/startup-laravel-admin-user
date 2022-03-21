<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('admins', App\Http\Controllers\API\AdminAPIController::class);
Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
Route::resource('notifications', App\Http\Controllers\API\NotificationAPIController::class);
Route::resource('providers', App\Http\Controllers\API\ProviderAPIController::class);

Route::resource('contacts', App\Http\Controllers\API\ContactAPIController::class);