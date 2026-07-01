<?php

use App\Http\Controllers\Api\ListRegisterApiController;
use App\Http\Controllers\Api\LocationShowroomApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TestDriverMethodApiController;
use Illuminate\Support\Facades\Route;





Route::get("/ListRegister",[ListRegisterApiController::class,'ListAccountRegister']);
Route::get("/DetailAccountRegister/{id}",[ListRegisterApiController::class,'DetailAccountRegister']);
Route::put("/UpdateAccountRegister/{id}",[ListRegisterApiController::class,'UpdateAccountRegister']);

Route::get('/GetListMethodTest',[TestDriverMethodApiController::class,'GetListMethodTest']);
Route::get('/GetListDetailMethodTest/{id}',[TestDriverMethodApiController::class,'GetListDetailMethodTest']);
Route::put('/UpdateListMethodTest/{id}',[TestDriverMethodApiController::class,'UpdateListMethodTest']);
Route::post('/insertMethodTest',[TestDriverMethodApiController::class,'insertMethodTest']);
Route::delete('/DeleteMethodTest/{id}',[TestDriverMethodApiController::class,'DeleteMethodTest']);

Route::delete(
    '/DeleteAlbumImage/{id}',
    [ProductApiController::class,'DeleteAlbumImage']
);

Route::get('/GetAllCategories',[ProductApiController::class,'GetAllCategories']);
Route::get('/GetListProduct',[ProductApiController::class,'GetListProduct']);
Route::get('/GetListDetailProduct/{id}',[ProductApiController::class,'GetListDetailProduct']);
Route::put('/UpdateProduct/{id}',[ProductApiController::class,'UpdateProduct']);
Route::post('/insertProduct',[ProductApiController::class,'insertProduct']);
Route::delete('/DeleteProduct/{id}',[ProductApiController::class,'DeleteProduct']);

Route::get('/GetListShowroom',[LocationShowroomApiController::class,'GetListShowroom']);
Route::get('/GetDetailShowroom/{id}',[LocationShowroomApiController::class,'GetDetailShowroom']);
Route::post('/insertShowroom',[LocationShowroomApiController::class,'insertShowroom']);
Route::put('/UpdateShowroom/{id}',[LocationShowroomApiController::class,'UpdateShowroom']);
Route::delete('/DeleteShowroom/{id}',[LocationShowroomApiController::class,'DeleteShowroom']);

Route::get('/GetListNews',[NewsApiController::class,'GetListNews']);
Route::get('/GetDetailNews/{id}',[NewsApiController::class,'GetDetailNews']);
Route::post('/insertNews',[NewsApiController::class,'insertNews']);
Route::put('/UpdateNews/{id}',[NewsApiController::class,'UpdateNews']);
Route::delete('/DeleteNews/{id}',[NewsApiController::class,'DeleteNews']);

