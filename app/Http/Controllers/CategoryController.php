<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    public function index(string $id)
    {
        try{
            $productByCategory = Product::where('category_id', $id)->paginate(12);
         
            return view('category', compact('productByCategory'));
        }catch(Throwable $e){
            return $e;
        }
    }

     /**
     * filter
     */
    public function filter(Request $request, string $id)
    {
        try{
        $query = Product::query();

        // filter by price
        if ($request->has('price')) {
            $priceRange = explode('-', $request->input('price'));
            $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        }
        // filter by name
        if ($request->has('sort')) {
            $sortOrder = $request->input('sort') === 'asc' ? 'asc' : 'desc';
            $query->orderBy('name', $sortOrder);
        }

        $products = $query->where('category_id', $id)->paginate(12);

        return view('filter', compact('products'));
    }catch(Throwable $e){
        return $e;
    }
    }
}
