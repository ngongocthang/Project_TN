<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    public function index(string $id)
    {
        try {
            $productByCategory = Product::where('category_id', $id)->paginate(12);

            return view('category', compact('productByCategory'));
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
            $categoryId = $request->input('id');

            // filter by price
            if ($request->has('price')) {
                $priceRange = explode('-', $request->input('price'));
                // check
                if (count($priceRange) === 2) {
                    $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
                } else {
                    return ("Invalid price range");
                    // return response()->json(['error' => 'Invalid price range'], 400);
                }
            }

            // filter by name/created_at
            if ($request->has('option')) {
                $optionRanger = $request->input('option') === '' ? 'name' : 'created_at';
                $query->orderBy('name', $optionRanger);
            }

            // filter order
            if ($request->has('sort')) {
                $sortOrder = $request->input('sort') === 'asc' ? 'asc' : 'desc';
                $query->orderBy('name', $sortOrder);
            }

            $products = $query->where('category_id', $categoryId)->paginate(12);

            return view('search', compact('products'));
            // return response()->json($products);
        } catch (Throwable $e) {
            return $e;
        }
    }
}
