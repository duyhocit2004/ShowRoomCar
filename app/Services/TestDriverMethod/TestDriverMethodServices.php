<?php

namespace App\Services\TestDriverMethod;

use App\Repositories\TestDriverMethodRepository;
use Illuminate\Http\Request;

class TestDriverMethodServices implements ITestDriverMethodServices
{
    protected TestDriverMethodRepository $TestDriverMethodRepository;

    public function __construct(TestDriverMethodRepository $TestDriverMethodRepository)
    {
        $this->TestDriverMethodRepository = $TestDriverMethodRepository;
    }

    public function GetListMethodTest(Request $Request)
    {
        $data = $this->TestDriverMethodRepository->GetListMethodTest($Request);

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

    public function GetListDetailMethodTest(string $id)
    {
        $data = $this->TestDriverMethodRepository->GetListDetailMethodTest($id);

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

    public function UpdateListMethodTest(Request $Request, string $id)
    {
        $data = $this->TestDriverMethodRepository->UpdateListMethodTest($Request, $id);

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

    public function insertMethodTest(Request $Request)
    {
        $data = $this->TestDriverMethodRepository->insertMethodTest($Request);

        return response()->json([
            'success' => true,
            'message' => 'Thêm thành công.',
            'data' => $data,
        ], 201);
    }

    public function DeleteMethodTest(string $id)
    {
        $result = $this->TestDriverMethodRepository->DeleteMethodTest($id);

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
