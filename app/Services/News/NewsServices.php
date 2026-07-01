<?php

namespace App\Services\News;

use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class NewsServices implements INewsServices
{
    protected NewsRepository $NewsRepository;

    public function __construct(NewsRepository $NewsRepository)
    {
        $this->NewsRepository = $NewsRepository;
    }

    public function GetListNews(Request $Request)
    {
        $data = $this->NewsRepository->GetListNews($Request);

        return response()->json([
            'success' => true,
            'message' => 'Lấy danh sách thành công.',
            'data' => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
        ]);
    }

    public function GetDetailNews(string $id)
    {
        $data = $this->NewsRepository->GetDetailNews($id);

        if (! $data) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy dữ liệu.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function UpdateNews(Request $Request, string $id)
    {
        $data = $this->NewsRepository->UpdateNews($Request, $id);

        if (! $data) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy dữ liệu.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công.',
            'data' => $data,
        ]);
    }

    public function insertNews(Request $Request)
    {
        $data = $this->NewsRepository->insertNews($Request);

        return response()->json([
            'success' => true,
            'message' => 'Thêm thành công.',
            'data' => $data,
        ], 201);
    }

    public function DeleteNews(string $id)
    {
        $result = $this->NewsRepository->DeleteNews($id);

        if (! $result) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy dữ liệu.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Xóa thành công.',
        ]);
    }
}
