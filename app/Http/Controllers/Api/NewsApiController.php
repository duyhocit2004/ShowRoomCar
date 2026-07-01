<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\News\INewsServices;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    protected INewsServices $NewsServices;

    public function __construct(INewsServices $NewsServices)
    {
        $this->NewsServices = $NewsServices;
    }

    public function GetListNews(Request $request)
    {
        return $this->NewsServices->GetListNews($request);
    }

    public function GetDetailNews(string $id)
    {
        return $this->NewsServices->GetDetailNews($id);
    }

    public function insertNews(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ: ' . $validator->errors()->first()
            ]);
        }

        return $this->NewsServices->insertNews($request);
    }

    public function UpdateNews(Request $request, string $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ: ' . $validator->errors()->first()
            ]);
        }

        return $this->NewsServices->UpdateNews($request, $id);
    }

    public function DeleteNews(string $id)
    {
        return $this->NewsServices->DeleteNews($id);
    }
}
