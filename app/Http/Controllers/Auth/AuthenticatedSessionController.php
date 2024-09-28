<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login'); // Trả về view đăng nhập
    }

    /**
     * Xử lý yêu cầu đăng nhập.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Xác thực thông tin đăng nhập
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Email là bắt buộc và phải có định dạng hợp lệ
            'password' => ['required'], // Mật khẩu là bắt buộc
        ]);

        // Thực hiện đăng nhập với thông tin đã xác thực
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            // Nếu không thành công, ném ra ngoại lệ với thông điệp lỗi
            throw ValidationException::withMessages([
                'email' => __('auth.failed'), // Thông điệp lỗi khi đăng nhập thất bại
            ]);
        }

        // Đổi mới phiên làm việc
        $request->session()->regenerate();

        // Chuyển hướng đến trang dashboard sau khi đăng nhập thành công
        return redirect()->intended('dashboard');
    }

    /**
     * Đăng xuất người dùng.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // Đăng xuất người dùng
        Auth::guard('web')->logout();

        // Hủy phiên làm việc
        $request->session()->invalidate();

        // Tạo lại token cho phiên làm việc
        $request->session()->regenerateToken();

        // Chuyển hướng về trang chủ sau khi đăng xuất
        return redirect('/');
    }
}
