<?php

namespace App\Services\News;

use Illuminate\Http\Request;

interface INewsServices {
    public function GetListNews(Request $Request);
    public function GetDetailNews(string $id);
    public function insertNews(Request $Request);
    public function UpdateNews(Request $Request, string $id);
    public function DeleteNews(string $id);
}
