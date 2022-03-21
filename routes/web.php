<?php

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

Route::get('/', 'HomeController@index')->name('home');

// Set Locale Route
Route::get('setlocale/{locale}', 'HomeController@setLocale')->name('localization');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@update')->name('profile.settings');
    Route::post('/password', 'ProfileController@password')->name('profile.password');
});

// require __DIR__.'/auth.php';

Auth::routes();