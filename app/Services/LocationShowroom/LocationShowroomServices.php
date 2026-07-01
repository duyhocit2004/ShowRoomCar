<?php

namespace App\Services\LocationShowroom;

use App\Repositories\LocationShowroomRepository;
use Illuminate\Http\Request;

class LocationShowroomServices implements ILocationShowroomServices
{
    protected LocationShowroomRepository $LocationShowroomRepository;

    public function __construct(LocationShowroomRepository $LocationShowroomRepository)
    {
        $this->LocationShowroomRepository = $LocationShowroomRepository;
    }

    public function GetListShowroom(Request $Request)
    {
        $data = $this->LocationShowroomRepository->GetListShowroom($Request);

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

    public function GetDetailShowroom(string $id)
    {
        $data = $this->LocationShowroomRepository->GetDetailShowroom($id);

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

    public function UpdateShowroom(Request $Request, string $id)
    {
        $data = $this->LocationShowroomRepository->UpdateShowroom($Request, $id);

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

    public function insertShowroom(Request $Request)
    {
        $data = $this->LocationShowroomRepository->insertShowroom($Request);

        return response()->json([
            'success' => true,
            'message' => 'Thêm thành công.',
            'data' => $data,
        ], 201);
    }

    public function DeleteShowroom(string $id)
    {
        $result = $this->LocationShowroomRepository->DeleteShowroom($id);

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
