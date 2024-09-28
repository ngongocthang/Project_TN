<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // Xử lý tải lên ảnh
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public'); // Lưu ảnh vào thư mục public/thumbnails
        }

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'thumbnail' => $thumbnailPath, // Lưu đường dẫn thumbnail
        ]);

        // Gửi sự kiện đăng ký
        event(new Registered($user));

        // Đăng nhập người dùng ngay sau khi đăng ký
        Auth::login($user);

        // Chuyển hướng đến trang dashboard sau khi đăng ký thành công
        return redirect()->intended('dashboard');
    }
}
