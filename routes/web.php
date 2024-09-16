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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/product', function () {
    return view('products.product');
})->name('product');

Route::get('/detail', function () {
    return view('products.detail');
})->name('detail');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/category', function () {
    return view('category');
})->name('category');

Route::get('/checkout', function () {
    return view('mycart.checkout');
})->name('checkout');

Route::get('/shopping-cart', function () {
    return view('mycart.shopping-cart');
})->name('shopping-cart ');

Route::get('/wishlist', function () {
    return view('mycart.wishlist');
})->name('wishlist');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/404', function () {
    return view('404');
})->name('404');