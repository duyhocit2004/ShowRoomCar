<?php

use App\Http\Controllers\Api\ListRegisterApiController;
use Illuminate\Support\Facades\Route;



Route::get("/ListRegister",[ListRegisterApiController::class,'ListAccountRegister']);
Route::get("/DetailAccountRegister/{id}",[ListRegisterApiController::class,'DetailAccountRegister']);
Route::put("/UpdateAccountRegister/{id}",[ListRegisterApiController::class,'UpdateAccountRegister']);
