<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Route สินค้า (CRUD)
Route::resource('products', ProductController::class);

// Route หน้าแรก
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Route dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Cart routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.process');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Route โปรไฟล์
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';