<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductEditRequest;
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
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'image' => $imagePath,
                'quantity' => $validatedData['quantity'],
                'price' => $validatedData['price'],
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
    public function update(ProductEditRequest $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $validatedData = $request->validated();
            $status = '';

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $imagePath;
            }else{
                $imagePath = $request->old_image;
            }

            if ($product->quantity == 0) {
                $status = 'sold';
            }elseif ($product->quantity > 0) {
                $status = 'available';
            }

            $product->update([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'status' => $status,
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
}
