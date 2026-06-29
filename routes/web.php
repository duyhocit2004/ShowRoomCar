<?php

use App\Http\Controllers\Admins\ListRegisterController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

Route::get('FormLoginAdmin', [AuthController::class, 'FormLogin'])->name('FormLoginAdmin');
Route::post('loginAccount', [AuthController::class, 'loginAccount'])->name('loginAccount');



Route::prefix('admin')->middleware('jwt.blade')->group(function () {
        Route::get('/', function () {
            return view('admins.index');
        });
    Route::get('Logout', [AuthController::class, 'Logout'])->name('Logout');

    Route::prefix('table')->group(function () {
        Route::get('/', function () {
            return view('admins.dashboard');
        })->name('admin.table');

        Route::get('ListRegister',[ListRegisterController::class,'ListAccountRegister'])->name('ListRegister');
    });

});
