<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function FormLogin()
    {

        if (request()->cookie('jwt_token')) {
            return redirect()->route('admin.table');
        }

        return view('auth.loginAdmin');
    }

    public function loginAccount(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            // kiểm tra tk và sinh ra token

            if (! $token = Auth::guard('api')->attempt($credentials)) {
                return redirect()->back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không chính xác.');
            }
            // dd($credentials);
            // tiến hành giải mã lấy thông tin vừa tạo
            $user = JWTAuth::setToken($token)->authenticate();

            if ($user->role !== 'admin') {
                // nếu người đăng nhập không phải admin hủy ngay token
                JWTAuth::invalidate($token);

                return redirect()->back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không chính xác.');

            }

            return redirect()->route('admin.table')
                ->cookie('jwt_token', $token, 60);
        } catch (\Throwable $th) {
            return redirect()->route('FormLoginAdmin')->with('error', 'Có lỗi xảy ra trong quá trình xác thực giải mã.');
        }
    }

    public function Logout(Request $request)
    {
        try {
            if (! $token = $request->cookie('jwt_token')) {
                return redirect()->route('FormLoginAdmin')->with('error', 'vui lòng đăng nhập');
            }

            // Lấy token từ header Authorization
            if ($token) {
            // 2. DÙNG JWT ĐỂ XÓA: Vô hiệu hóa và đưa token này vào danh sách đen (Blacklist)
            JWTAuth::setToken($token)->invalidate();
            }

            return redirect()->route('FormLoginAdmin')->with('success', 'Đăng nhập thành công')->withoutCookie('jwt_token');
        } catch (\Throwable $th) {
            return redirect()->route('FormLoginAdmin')->with('error', $th->getMessage())->withoutCookie('jwt_token');
        }
    }
}
