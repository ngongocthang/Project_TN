<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ProductSoldController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route chính
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route cho người dùng đã xác thực
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Route cho khách
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Route cho Home
Route::get('/filter', [HomeController::class, 'filter'])->name('filter-search');
Route::get('/detail-product/{id}', [HomeController::class, 'detail'])->name('detail-product');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Route cho giỏ hàng
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/page-cart', [CartController::class, 'showCart'])->name('page-cart');
Route::delete('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('delete-cart');
Route::put('/update-cart/{id}', [CartController::class, 'updateCart'])->name('update-cart');

// Route cho wishlist
Route::get('/wishlist/{id}', [HomeController::class, 'wishlist'])->name('wishlist');
Route::get('/page-wishlist', [HomeController::class, 'deleteWishlist'])->name('page-wishlist');
Route::delete('/delete-wishlist/{id}', [HomeController::class, 'deleteWishlist'])->name('delete-wishlist');

// Route cho checkout
Route::get('/checkout-page', [CartController::class, 'showCartCheckout'])->name('checkout-page');
Route::post('/checkout', [CartController::class, 'handleCheckout'])->name('checkout');

// Route cho sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/filter-products', [ProductController::class, 'filter'])->name('filter-products');
Route::get('/search-products', [ProductController::class, 'search'])->name('search-products');

// Route cho danh mục
Route::get('/categories/{id}', [CategoryController::class, 'index'])->name('categories');
Route::get('/filter-categories', [CategoryController::class, 'filter'])->name('filter-categories');
Route::get('/search-categories', [CategoryController::class, 'search'])->name('search-categories');


// Route cho admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard-admin');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class, ['names' => 'products']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class, ['names' => 'categories']);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class, ['names' => 'orders']);
    Route::resource('order-items', App\Http\Controllers\Admin\OrderItemController::class, ['names' => 'order-items']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class, ['names' => 'users']);
});

Route::get('/dashboard/products', [ProductController::class, 'index'])->name('dashboard.products.index');
Route::get('/dashboard/product-solds', [ProductSoldController::class, 'index'])->name('dashboard.product-solds.index');
Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories.index');
Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders.index');
Route::get('/dashboard/order-items', [OrderItemController::class, 'index'])->name('dashboard.order-items.index');
Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
Route::get('/dashboard/blogs', [BlogController::class, 'index'])->name('dashboard.blogs.index');
Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// Route để xóa hình ảnh
Route::patch('/profile/image/delete', [ProfileController::class, 'deleteImage'])->name('profile.image.delete');

require __DIR__ . '/auth.php';

