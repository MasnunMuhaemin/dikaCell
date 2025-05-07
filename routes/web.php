<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerifyOtpController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.landing'); 
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/pages/app', function () {
        return view('pages.landing'); 
    })->name('pages.app');
});

Route::prefix('auth')->group(function () {
    Route::get('/verify-otp', [VerifyOtpController::class, 'showForm'])->name('auth.verify.otp.form');
    Route::post('/verify-otp', [VerifyOtpController::class, 'verifyOtp'])->name('auth.verify.otp.submit');
    Route::post('/resend-otp', [VerifyOtpController::class, 'resendOtp'])->name('auth.resend.otp');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'loginVerify'])->name('auth.loginVerify');
    Route::post('/register', [AuthController::class, 'registerVerify'])->name('auth.registerVerify');
});
