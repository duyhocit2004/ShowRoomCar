<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TestDriverMethod\ITestDriverMethodServices;
use Illuminate\Http\Request;

class TestDriverMethodApiController extends Controller
{
    protected ITestDriverMethodServices $TestDriverMethod;

    public function __construct(ITestDriverMethodServices $TestDriverMethod)
    {
        $this->TestDriverMethod = $TestDriverMethod;
    }

    public function GetListMethodTest(Request $Request)
    {
        return $this->TestDriverMethod->GetListMethodTest($Request);
    }

    public function GetListDetailMethodTest(string $id)
    {
        return $this->TestDriverMethod->GetListDetailMethodTest($id);
    }

    public function UpdateListMethodTest(Request $Request,string $id)
    {
        return $this->TestDriverMethod->UpdateListMethodTest($Request,$id);
    }

    public function insertMethodTest(Request $Request)
    {
        return $this->TestDriverMethod->insertMethodTest($Request);
    }

    public function DeleteMethodTest(string $id)
    {
        return $this->TestDriverMethod->DeleteMethodTest($id);
    }
}