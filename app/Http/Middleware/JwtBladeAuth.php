<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
class JwtBladeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // 1.đọc chuốc token được lưu trữ trong cookie(jwt_token);
        $token = $request->cookie('jwt_token');

        if(!$token){
            return redirect()->route('FormLoginAdmin')->with('error', 'Vui lòng đăng nhập trước.');
        }

        try {
            // 2. Gán chuỗi token vào hệ thống quản lý JWT
             JWTAuth::setToken($token);

             // 3.giải mã định danh xem tài khoản có hợp lệ không
             if (!$user = JWTAuth::authenticate()) {
                return redirect()->route('FormLoginAdmin')->with('error', 'Tài khoản không tồn tại.');
            }

            // 4. Đồng bộ hóa đăng nhập vào biến Auth toàn cục để các file Blade gọi được Auth::user()
            auth()->login($user);

        } catch (\Throwable $th) {
            // Trường hợp token hết hạn, bị chỉnh sửa hoặc lỗi hệ thống
            return redirect()->route('FormLoginAdmin')->with('error', 'Phiên đăng nhập hết hạn hoặc không hợp lệ.');
        }
        return $next($request);
    }
}
