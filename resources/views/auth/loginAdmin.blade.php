<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from laravel.spruko.com/clont/Leftmenu-Icon-LightSidebar-ltr/login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2026 08:13:05 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    @include('admins.layout.head')
</head>

<body class="h-100vh">

<div class="page w-100">
        <div class="page-single">
            <div class="container">
                <div class="row justify-content-center">
                    
                    <!-- Thay đổi 2: Gom toàn bộ tiêu đề và form vào chung một khối col-md-5 hoặc col-lg-4 để thu hẹp chiều ngang -->
                    <div class="col-12 col-sm-8 col-md-5 col-lg-4">
                        
                        <!-- Tiêu đề -->
                        <div class="text-center mb-4">
                            <p class="h3 font-weight-bold text-primary">Trang quản trị viên</p>
                        </div>
                        
                        <!-- Khối Form Đăng Nhập -->
                        <div class="card shadow-sm">
                            <div class="card-body p-4"> <!-- Giảm bớt p-5 xuống p-4 để form thon gọn hơn -->
                                <form action="{{ route('loginAccount') }}" method="POST" >
                                    @csrf
                                    <h3 class="mb-2 font-weight-bold">Đăng nhập</h3>
                                    <p class="text-muted small mb-4">Đăng nhập tài khoản hệ thống</p>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"> <!-- Khuyên dùng cấu trúc này cho Bootstrap 4 -->
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div> <!-- Hết khối giới hạn độ rộng -->
                    
                </div>
            </div>
        </div>
    </div>

    @include('admins.layout.js')
    <!-- Jquery js-->

</body>

<!-- Mirrored from laravel.spruko.com/clont/Leftmenu-Icon-LightSidebar-ltr/login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2026 08:13:06 GMT -->

</html>