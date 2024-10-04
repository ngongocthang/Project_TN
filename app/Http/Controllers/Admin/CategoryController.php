<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryEditRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Throwable;


class CategoryController extends Controller
{
    
    /**
     * Tra ve giao dien trang chu 
     */
    public function index()
    {
        try {
            $categories = Category::paginate(10);
            return view('admin.categories.index', compact('categories'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Tra ve giao dien trang tao moi 
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * ham tao xu li tao moi
     */
    public function store(CategoryRequest $request)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('categories', 'public');
            }

            $category = Category::create([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);

            if ($category) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Category Created Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }

            toastr()->timeOut(7000)->closeButton()->addError('Category Created Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * hien thi categories
     */
    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.show', compact('category'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Tra ve giao dien trang tao cap nhat 
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.edit', compact('category'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Ham xu li cap nhat
     */
    public function update(CategoryEditRequest $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('categories', 'public');
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $category->image = $imagePath;
            }else{
                $imagePath = $request->old_image;
            }

            $category->update([
                'image' => $imagePath,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);
            $category->save();
            if ($category) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Category Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Category Updated Fail!');
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
            $category = Category::destroy($id);
            if ($category) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Category Delete Successfully!');
                return redirect()->route('dashboard.categories.index');
            }
            toastr()->timeOut(7000)->closeButton()->addSuccess('Category Delete Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }
}
