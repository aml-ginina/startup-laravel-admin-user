<?php

Route::namespace('\App\Http\Controllers\Admin\Auth')->group(function() {
    // Login and Logout
    Route::GET('/login', 'LoginController@showLoginForm')->name('login');
    Route::POST('/login', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('logout');

    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

Route::middleware('auth:admin')->group(function ()
{
    Route::GET('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@update')->name('profile.settings');
    Route::post('/password', 'ProfileController@password')->name('profile.password');

    Route::resource('admins', 'AdminController');
    Route::resource('users', 'UserController');
    Route::resource('notifications', 'NotificationController')->except('edit');
    
});

Route::fallback(function () {
    return abort(404);
});