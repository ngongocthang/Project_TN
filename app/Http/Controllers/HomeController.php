<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class HomeController extends Controller
{
    /**
     * page home
     */
    public function index()
    {
        $hotProduct = Product::orderBy('view', 'desc')->get();
        $newProduct = Product::orderBy('created_at', 'desc')->get();
        $products = Product::all();
        $blogList = Blog::all();

        return view('home', compact('hotProduct', 'newProduct', 'blogList', 'products'));
    }

    /**
     * show detail product
     */
    public function detail(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $relatedProduct = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();

            // increment view when viewing details
            if ($product) {
                $product->increment('view');
                $product->save();
            }

            return view('detail', compact('product', 'relatedProduct'));
            // return response()->json([
            //     'productDetail' => $product,
            //     'productRelated' => $relatedProduct
            // ]);
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * search ( compact query use filter search)
     */
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $queries = Product::where('name', 'LIKE', "%$query%");
            $products = $queries->paginate(12);

            return view('search', compact('products', 'query'));
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * filter search
     */
    public function filter(Request $request)
    {
        try {
            $query = Product::query();
            $search = $request->input('query');

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

            $products = $query->where('name', 'LIKE', "%$search%")->paginate(12);

            // return view('search', compact('products'));
            return response()->json($products);
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * wishlist
     */
    public function wishlist(Request $request, string $id)
    {
        $quantity = $request->get('quantity', 1);
        $product = Product::findOrFail($id);
        if (!$product) {
            return "error!";
        }

        $like = session()->get('like', []);
        if (isset($like[$id])) {
            $like[$id]['quantity'] += $quantity;
        } else {
            $like[$id] = [
                'id' => $product->id,
                'image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }
        session()->put('like', $like);
        return redirect()->back()->with('success', ' Add wishlist success!');
    }

    /**
     * show wishlist
     */
    public function showWishlist()
    {
        $like = session()->get('like', []);

        if (empty($like)) {;
            return view('wishlist');
        } else {
            return view('wishlist', compact('like'));
        }
    }

    /**
     * delete wishlist
     */
    public function deleteWishlist(string $id)
    {
        $like = session()->get('like', []);
        if (isset($like[$id])) {
            unset($like[$id]);
        }
        session()->put('like', $like);
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi thích!');
    }

    /**
     * contact
     */
    public function contact()
    {
        try {
            return view('contact');
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * about
     */
    public function about()
    {
        try {
            return view('about');
        } catch (Throwable $e) {
            return $e;
        }
    }
}
