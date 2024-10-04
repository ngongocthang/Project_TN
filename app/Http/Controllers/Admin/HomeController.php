<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Throwable;

class HomeController extends Controller
{
    
    /**
     * view dashboard.
     */
    public function index()
    {
        try {
            $products = Product::all()->count();
            $categories = Category::all()->count();
            $users = User::all()->count();
            $blogs = Blog::all()->count();
            $blogNews = Blog::orderBy('created_at', 'desc')->take(5)->get();

            return view('admin.index', compact('products', 'categories', 'users', 'blogs', 'blogNews'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * view dashboard.
     */
    public function error()
    {
        try {
            return view('admin.error');
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }
}
