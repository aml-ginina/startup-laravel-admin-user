<?php

Route::namespace('\App\Http\Controllers\Provider\Auth')->group(function() {
    // Login and Logout
    Route::GET('/login', 'LoginController@showLoginForm')->name('login');
    Route::POST('/login', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('logout');

    // Registration
    Route::GET('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::POST('/register', 'RegisterController@register');

    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');

    //Verification Routes
    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
});

// Auth::routes(['verify' => true]);

Route::middleware('auth:provider')->group(function ()
{
    Route::GET('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@update')->name('profile.settings');
    Route::post('/password', 'ProfileController@password')->name('profile.password');
    Route::resource('notifications', 'NotificationController')->except('edit', 'create', 'store');

});

Route::fallback(function () {
    return abort(404);
});