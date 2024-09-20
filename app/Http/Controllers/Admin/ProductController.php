<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductController extends Controller
{
    /**
     * Tra ve giao dien trang chu 
     */
    public function index()
    {
        try {
            $products = Product::paginate(10);
            return view('admin.products.index', compact('products'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * tra ve giao dien create.
     */
    public function create()
    {
        try {
            $categories = Category::all();
            return view('admin.products.create', compact('categories'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * them moi product
     */
    public function store(ProductRequest $request)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
            }

            $product = Product::create([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'status' => $validatedData['status'],
                'category_id' => $validatedData['category_id'],
            ]);

            if ($product) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Created Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }

            toastr()->timeOut(7000)->closeButton()->addError('Product Created Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * hien thi product
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.products.show', compact('product'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Tra ve giao dien trang cap nhat 
     */
    public function edit(string $id)
    {
        try {
            $categories = Category::all();
            $product = Product::findOrFail($id);
            return view('admin.products.edit', compact('product', 'categories'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * ham xu li cap nhat.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $imagePath;
            }
            $product->update([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'status' => $validatedData['status'],
                'category_id' => $validatedData['category_id'],
            ]);
            $product->save();
            if ($product) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Product Updated Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Ham xu li xoa
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product) {
                $product->orderItems()->delete();
                $product->delete();
                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Delete Successfully!');
                return redirect()->back();
            }
            toastr()->timeOut(7000)->closeButton()->addError('Product Not Found!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * tra ve giao dien product sale
     */
    public function getProductSales()
    {
        try {
            $products = Product::where('status', 'sale')->paginate(10);
            return view('admin.products.sale.index', compact('products'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * tra ve giao dien show product sale
     */
    public function showProductSales($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.products.sale.show', compact('product'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * tra ve giao dien create product sale
     */
    public function createProductSales()
    {
        try {
            $categories = Category::all();
            return view('admin.products.sale.create', compact('categories'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * xu li create product sale
     */
    public function storeProductSales(ProductRequest $request)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
            }

            $product = Product::create([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'status' => $validatedData['status'],
                'category_id' => $validatedData['category_id'],
            ]);

            if ($product) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Created Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }

            toastr()->timeOut(7000)->closeButton()->addError('Product Created Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * tra ve giao dien update product sale
     */
    public function editProductSales($id)
    {
        try {
            $categories = Category::all();
            $product = Product::findOrFail($id);
            return view('admin.products.sale.edit', compact('product', 'categories'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * xu li update product sale
     */
    public function updateProductSales(ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $imagePath;
            }
            $product->update([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'status' => $validatedData['status'],
                'category_id' => $validatedData['category_id'],
            ]);
            $product->save();
            if ($product) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Product Updated Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    

    /**
     * tra ve giao dien product sold
     */
    public function getProductSolds()
    {
        try {
            $products = Product::where('status', 'sold')->paginate(10);
            return view('admin.products.sold.index', compact('products'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * tra ve giao dien show product sold
     */
    public function showProductSolds($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.products.sold.show', compact('product'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * tra ve giao dien update product sold
     */
    public function editProductSolds($id)
    {
        try {
            $categories = Category::all();
            $product = Product::findOrFail($id);
            return view('admin.products.sold.edit', compact('product', 'categories'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * xu li update product sold
     */
    public function updateProductSolds( ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $imagePath;
            }
            $product->update([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'status' => $validatedData['status'],
                'category_id' => $validatedData['category_id'],
            ]);
            $product->save();
            if ($product) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Product Updated Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
