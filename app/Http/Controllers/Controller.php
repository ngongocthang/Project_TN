<?php

namespace App\Http\Controllers;

use App\Models\Category;

abstract class Controller
{
    // share data all view
    public function __construct()
    {
        $categoryList =Category::all(); 
        view()->share('categoryList', $categoryList);
    }
}
