<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::paginate(10);
            return view('admin.users.index', compact('users'));
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
            return view('admin.users.create');
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * them moi product
     */
    public function store(UserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('users', 'public');
                $user = User::create([
                    'image' => $imagePath,
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => $validatedData['password'],
                    'phone' => $validatedData['phone'],
                    'role' => $validatedData['role'],
                ]);
            }else{
                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => $validatedData['password'],
                    'phone' => $validatedData['phone'],
                    'role' => $validatedData['role'],
                ]);
            }
            if ($user) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('User Created Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }

            toastr()->timeOut(7000)->closeButton()->addError('User Created Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * hien thi user
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
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
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * ham xu li cap nhat.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('users', 'public');
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                $user->image = $imagePath;
                $user->update([
                    'image' => $imagePath,
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => $validatedData['password'],
                    'phone' => $validatedData['phone'],
                    'role' => $validatedData['role'],
                ]);
                $user->save();
            } else {
                $user->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => $validatedData['password'],
                    'phone' => $validatedData['phone'],
                    'role' => $validatedData['role'],
                ]);
                $user->save();
            }

            if ($user) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('User Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('User Updated Fail!');
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
            $user = User::findOrFail($id);
            if ($user) {
                $user->orders()->delete();
                $user->delete();
                toastr()->timeOut(7000)->closeButton()->addSuccess('User Delete Successfully!');
                return redirect()->back();
            }
            toastr()->timeOut(7000)->closeButton()->addError('User Not Found!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
