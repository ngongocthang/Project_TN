<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/filter', [HomeController::class, 'filter'])->name('filter-search');
Route::get('/detail-product/{id}', [HomeController::class, 'detail'])->name('detail-product');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// add to cart
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/page-cart', [CartController::class, 'showCart'])->name('page-cart');
Route::delete('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('delete-cart');
Route::put('/update-cart/{id}', [CartController::class, 'updateCart'])->name('update-cart');

// like
Route::get('/wishlist/{id}', [HomeController::class, 'wishlist'])->name('wishlist');
Route::get('/page-wishlist', [HomeController::class, 'deleteWishlist'])->name('page-wishlist');
Route::delete('/delete-wishlist/{id}', [HomeController::class, 'deleteWishlist'])->name('delete-wishlist');

//checkout
Route::get('/checkout-page', [CartController::class, 'showCartCheckout'])->name('checkout-page');
Route::post('/checkout', [CartController::class, 'handleCheckout'])->name('checkout');

//product
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/filter-products', [ProductController::class, 'filter'])->name('filter-products');
Route::get('/search-products', [ProductController::class, 'search'])->name('search-products');

//category
Route::get('/categories/{id}', [CategoryController::class, 'index'])->name('categories');
Route::get('/filter-categories', [CategoryController::class, 'filter'])->name('filter-categories');
Route::get('/search-categories', [CategoryController::class, 'search'])->name('search-categories');

// admin
Route::middleware(['checkUrl'])->prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');
    Route::get('/errors', [App\Http\Controllers\Admin\HomeController::class, 'error'])->name('dashboard.error');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class, ['names' => 'dashboard.products']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class, ['names' => 'dashboard.categories']);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class, ['names' => 'dashboard.orders']);
    Route::resource('order-items', App\Http\Controllers\Admin\OrderItemController::class, ['names' => 'dashboard.order-items']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class, ['names' => 'dashboard.users']);
    Route::get('user-metas', [App\Http\Controllers\Admin\UserMetaController::class, 'show'])->name('dashboard.user-metas');
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class,  ['names' => 'dashboard.blogs']);
    Route::resource('product-solds', App\Http\Controllers\Admin\ProductSoldController::class, ['names' => 'dashboard.product-solds']);
}); 