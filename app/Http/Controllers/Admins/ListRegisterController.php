<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Services\ListFormRegister\ListFormRegisterServices;
use Illuminate\Http\Request;

class ListRegisterController extends Controller
{

    public function ListAccountRegister(Request $request) {
        return view('admins.FormRegister.listFormRegister');
    }

}
