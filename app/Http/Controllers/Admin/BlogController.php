<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogEditRequest;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BlogController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        try {
            $blogs = Blog::paginate(10);

            return view('admin.blogs.index', compact('blogs'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * 
     */
    public function create()
    {
        try {
            $users = User::all();

            return view('admin.blogs.create', compact('users'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * 
     */
    public function store(BlogRequest $request)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('blogs', 'public');
            }

            $blog = Blog::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image' => $imagePath,
                'content' => $validatedData['content'],
                'user_id' => $validatedData['user_id'],
            ]);

            if ($blog) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Blog Created Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }

            toastr()->timeOut(7000)->closeButton()->addError('Blog Created Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * 
     */
    public function show(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            return view('admin.blogs.show', compact('blog'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * 
     */
    public function edit(string $id)
    {
        try {
            $users = User::all();
            $blog = Blog::findOrFail($id);

            return view('admin.blogs.edit', compact('blog', 'users'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * 
     */
    public function update(BlogEditRequest $request, string $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('blogs', 'public');
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
                $blog->image = $imagePath;
            } else {
                $imagePath = $request->old_image;
            }

            $blog->update([
                'image' => $imagePath,
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'content' => $validatedData['content'],
                'user_id' => $validatedData['user_id'],
            ]);
            $blog->save();
            if ($blog) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('Blog Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Blog Updated Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * 
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if ($blog) {
                $blog->delete();

                toastr()->timeOut(7000)->closeButton()->addSuccess('Blog Delete Successfully!');
                return redirect()->back();
            }
            toastr()->timeOut(7000)->closeButton()->addError('Blog Not Found!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }
}
