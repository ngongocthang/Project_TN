<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest; // Import UserRequest
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class RegisteredUserController extends Controller
{
    /**
     * Hiển thị trang đăng ký người dùng mới.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register'); // Trả về view cho trang đăng ký
    }

    /**
     * Xử lý yêu cầu đăng ký người dùng mới.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request) // Sử dụng UserRequest
    {
        try {
            $validated = $request->validated(); // Bây giờ có thể gọi validated()

            // Tạo người dùng mới
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Xử lý tải lên ảnh
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('user-metas', 'public');
            }

            // Tạo bản ghi UserMeta
            UserMeta::create([
                'thumbnail' => $thumbnailPath,
                'phone' => $validated['phone'],
                'role' => $validated['role'] ?? 'user',
                'address' => $validated['address'] ?? null, // Thêm trường address
                'user_id' => $user->id,
            ]);

            // Gửi sự kiện đăng ký
            event(new Registered($user));

            // Đăng nhập người dùng ngay sau khi đăng ký
            Auth::login($user);

            // Chuyển hướng đến trang dashboard sau khi đăng ký thành công
            return redirect()->intended('dashboard');
        } catch (Throwable $e) {
            // toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
}
