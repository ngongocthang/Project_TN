<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductEditRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductSoldController extends Controller
{
    /**
     * tra ve giao dien product sold
     */
    public function index()
    {
        try {
            $products = Product::where('status', 'sold')->paginate(10);
            return view('admin.products.sold.index', compact('products'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * tra ve giao dien show product sold
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.products.sold.show', compact('product'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * tra ve giao dien update product sold
     */
    public function edit($id)
    {
        try {
            $categories = Category::all();
            $product = Product::findOrFail($id);
            return view('admin.products.sold.edit', compact('product', 'categories'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * handle update product sold
     */
    public function update(ProductEditRequest $request, $id)
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
                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Sold Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Product Sold Updated Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
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

                toastr()->timeOut(7000)->closeButton()->addSuccess('Product Sold Delete Successfully!');
                return redirect()->route('dashboard.product-solds.index');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Product Sold Not Found!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }
}
