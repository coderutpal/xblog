<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});


/**
 * TESTING ROUTES
 */
route::view('/example-page', 'example-page');
route::view('/example-auth', 'example-auth');
Route::view('/test', 'back.pages.auth.test');

/**
 * ADMIN ROUTES
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest', 'preventBackHistory'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/forget-password', 'forgetForm')->name('forget');
            Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('password/reset/{token}', 'resetForm')->name('reset_password_form');
            Route::post('reset-password-handler', 'resetPasswordHandler')->name('reset_password_handler');
        });
    });

    Route::middleware(['auth', 'preventBackHistory'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::post('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile', 'profileView')->name('profile');
            Route::post('update-profile-picture', 'updateProfilePicture')->name('update_profile_picture');
            Route::get('/settings', 'generalSettings')->name('settings');
            Route::post('/update-logo', 'updateLogo')->name('update_logo');
            Route::post('/update-favicon', 'updateFavicon')->name('update_favicon');
        });
    });
});
