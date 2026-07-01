<?php

use App\Http\Controllers\Admins\ListRegisterController;
use App\Http\Controllers\Admins\ListTestMethodController;
use App\Http\Controllers\Admins\LocationShowroomController;
use App\Http\Controllers\Admins\NewsController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('index');
});

Route::get('FormLoginAdmin', [AuthController::class, 'FormLogin'])->name('FormLoginAdmin');
Route::post('loginAccount', [AuthController::class, 'loginAccount'])->name('loginAccount');



Route::prefix('admin')->middleware('jwt.blade')->group(function () {
    Route::get('Logout', [AuthController::class, 'Logout'])->name('Logout');

        Route::get('/', function () {
            return view('admins.dashboard');
        
        })->name('admin.table');

    Route::prefix('news')->group(function () {
        Route::get('ListRegister',[ListRegisterController::class,'ListAccountRegister'])->name('ListRegister');
        Route::get('RenderProduct',[ProductController::class,'RenderProduct'])->name('RenderProduct');
        
    });
        
    // danh sách đăng ký
    Route::prefix('table')->group(function () {
        Route::get('ListRegister',[ListRegisterController::class,'ListAccountRegister'])->name('ListRegister');
        
        
    });

    // dánh sách phân loại
    Route::prefix('classify')->group(function(){
        Route::get('ListFormMethodTest',[ListTestMethodController::class,'RenderFormTestMethod'])->name('ListFormMethodTest');
    });

    // Location Showrooms
    Route::prefix('showroom')->group(function(){
        Route::get('LocationShowroom',[LocationShowroomController::class,'RenderLocationShowroom'])->name('LocationShowroom');
    });

    // News
    Route::prefix('news')->group(function(){
        Route::get('ListNews',[NewsController::class,'RenderNews'])->name('ListNews');
    });

});
