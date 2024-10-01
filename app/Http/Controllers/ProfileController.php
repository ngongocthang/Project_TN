<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\UserMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function update(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cập nhật thông tin người dùng
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // Lưu hình ảnh nếu có
        if ($request->hasFile('thumbnail')) { // Đảm bảo rằng bạn đang kiểm tra đúng tên trường
            $thumbnail = $request->file('thumbnail')->store('user-metas', 'public');
            // Kiểm tra xem userMeta có tồn tại không
            if ($user->userMeta) {
                $user->userMeta->thumbnail = $thumbnail; // Cập nhật đường dẫn hình ảnh
            }
        }

        $request->user()->save();

        // Cập nhật thông tin trong user_metas
        $userMeta = $user->userMeta;

        // Nếu userMeta không tồn tại, tạo mới
        if (!$userMeta) {
            $userMeta = new UserMeta();
            $userMeta->user_id = $user->id; // Gán user_id
        }

        // Cập nhật địa chỉ và số điện thoại
        $userMeta->address = $request->address;
        $userMeta->phone = $request->phone;
        $userMeta->save(); // Lưu thông tin userMeta

        return redirect()->back();
    }
}
