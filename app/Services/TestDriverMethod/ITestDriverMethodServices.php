<?php

namespace App\Services\TestDriverMethod;

use Illuminate\Http\Request;


interface ITestDriverMethodServices {
    public function GetListMethodTest(Request $Request);
    public function GetListDetailMethodTest(string $id);
    public function UpdateListMethodTest(Request $Request,string $id);
    public function insertMethodTest(Request $Request);
    public function DeleteMethodTest(string $id);

}