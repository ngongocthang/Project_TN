<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $listProduct = Product::paginate(12);

            return view('product', compact('listProduct'));
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * filter
     */
    public function filter(Request $request)
    {
        try {
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

            $products = $query->paginate(12);

            return view('filter', compact('products'));
        } catch (Throwable $e) {
            return $e;
        }
    }
}
