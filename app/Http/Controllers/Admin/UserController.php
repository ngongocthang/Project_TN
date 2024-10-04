<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UserController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        try {
            $users = User::paginate(10);

            return view('admin.users.index', compact('users'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * tra ve giao dien create.
     */
    public function create()
    {
        try {
            //check permissions
            if (Gate::denies('create', User::class)) {
                return abort(403, 'Unauthorized');
            }

            return view('admin.users.create');
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * them moi product
     */
    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = User::create($validated);

            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('user-metas', 'public');
                UserMeta::create([
                    'thumbnail' => $imagePath,
                    'phone' => $validated['phone'],
                    'role' => $validated['role'],
                    'user_id' => $user->id,
                ]);
            } else {
                UserMeta::create([
                    'phone' => $validated['phone'],
                    'role' => $validated['role'],
                    'user_id' => $user->id
                ]);
            }

            if ($user) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('User Created Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('User Created Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
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
            return ('An error occurred: ' . $e->getMessage());
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
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * ham xu li cap nhat.
     */
    public function update(UserEditRequest $request, string $id)
    {
        try {
            $validated = $request->validated();
            $user = User::findOrFail($id);
            $userMeta = UserMeta::where('user_id', $id)->firstOrFail();

            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('user-metas', 'public');
                if ($userMeta->thumbnail) {
                    Storage::disk('public')->delete($userMeta->thumbnail);
                }
                $userMeta->thumbnail = $imagePath;
            } else {
                $imagePath = $request->old_thumbnail;
            }

            if ($validated["address"] != null) {
                $userMeta->update([
                    'thumbnail' => $imagePath,
                    'phone' => $validated['phone'],
                    'role' => $validated['role'],
                    'address' => $validated['address']
                ]);
            } else {
                $userMeta->update([
                    'thumbnail' => $imagePath,
                    'phone' => $validated['phone'],
                    'role' => $validated['role']
                ]);
            }

            $userMeta->save();
            $user->update($validated);
            if ($user) {
                toastr()->timeOut(7000)->closeButton()->addSuccess('User Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');;
            }
            toastr()->timeOut(7000)->closeButton()->addError('User Updated Fail!');
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
            $user = User::findOrFail($id);
            if ($user) {
                $user->delete();

                toastr()->timeOut(7000)->closeButton()->addSuccess('User Delete Successfully!');
                return redirect()->route('dashboard.users.index');
            }
            toastr()->timeOut(7000)->closeButton()->addError('User Not Found!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }
}
