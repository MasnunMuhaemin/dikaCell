<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifyOtpController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'landing'])->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/pages/app', [ProductController::class, 'landing'])->name('pages.app');

});

Route::get('/kategori/{id}', [ProductController::class, 'getProduct'])->name('category.products');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');

Route::prefix('auth')->group(function () {
    Route::get('/verify-otp', [VerifyOtpController::class, 'showForm'])->name('auth.verify.otp.form');
    Route::post('/verify-otp', [VerifyOtpController::class, 'verifyOtp'])->name('auth.verify.otp.submit');
    Route::post('/resend-otp', [VerifyOtpController::class, 'resendOtp'])->name('auth.resend.otp');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.id');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/checkout/payment{orderId}', [PaymentController::class, 'showPayment'])->name('checkout.payment');
    Route::post('/checkout/process', [PaymentController::class, 'processPayment'])->name('process.payment');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/konfirmasi-barang/{orderId}', [ProfileController::class, 'confirmShipment'])->name('confirm.shipment');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{wishlistId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'loginVerify'])->name('auth.loginVerify');
    Route::post('/register', [AuthController::class, 'registerVerify'])->name('auth.registerVerify');
});