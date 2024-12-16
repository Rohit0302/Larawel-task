<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'loginData'])->name('login');
Route::get('/registration', [HomeController::class, 'registration'])->name('registration');
Route::post('/registration', [HomeController::class, 'registrationUser'])->name('registration');

// Protected Routes with 'checkAuth' Middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/change-password', [DashboardController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('password.update');
    Route::get('/product-list', [ProductController::class, 'productlist'])->name('product-list');
    Route::get('/add-product', [ProductController::class, 'addproduct'])->name('add-product');
    Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');
    Route::post('/products/data', [ProductController::class, 'getData'])->name('products.data');
    Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/profile', [DashboardController::class, 'update'])->name('profile.update');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile.edit');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/card', [CartController::class, 'card'])->name('card');
    Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::POST('/card-list', [CartController::class, 'CardList'])->name('card-list');
    Route::delete('card/{id}', [CartController::class, 'destroy'])->name('card.destroy');

});






