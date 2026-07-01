<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListTestMethodController extends Controller
{
    public function RenderFormTestMethod(){
        return view('admins.ListTestMethod.ListFormMethod');
    }
}
