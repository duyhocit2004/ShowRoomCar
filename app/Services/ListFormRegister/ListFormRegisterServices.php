<?php

namespace App\Services\ListFormRegister;

use App\Repositories\ListFormRegisterRepository;
use Illuminate\Http\Request;

class ListFormRegisterServices implements IListFormRegisterServices
{
    protected $ListFormRegisterRepository;

    public function __construct(ListFormRegisterRepository $ListFormRegisterRepository)
    {
        $this->ListFormRegisterRepository = $ListFormRegisterRepository;
    }

    public function ListAccountRegister(Request $Request)
    {
        $name = $Request->input('name', '');
        $email = $Request->input('email', '');
        $status = $Request->input('status', '');

        $perPage = $Request->input('page', 10);

        // 2. TRUYỀN ĐỦ 4 THAM SỐ sang Repository
        $listRegisterTable = $this->ListFormRegisterRepository->ListAccountRegister($name, $email, $status, $perPage);

        return response()->json([
            'data' => $listRegisterTable,
            'message' => 'Lấy dữ liệu thành công', // Sửa lại chính tả chữ 'massage' thành 'message' nhé
        ]);
    }

    public function UpdateAccountRegister(string $id, Request $Request)
    {
        $data = $Request->only('name',
            'phone',
            'email',
            'car',
            'status',
            'testDriveMethod_id',
            'dateTest',
            'note');

        $updateRegisterTable = $this->ListFormRegisterRepository->UpdateAccountRegister($id,$data);

        return response()->json([
            'data' => $updateRegisterTable,
            'message' => 'Cập nhật dữ liệu thành công', // Sửa lại chính tả chữ 'massage' thành 'message' nhé
            'status' =>200
        ],200);
    }

    public function SoftDeleteAccountRegister(Request $Request) {}

    public function DetailAccountRegister(string $id)
    {

        // tham số truyền vào là ký tự thì trả về lỗi
        if (! is_numeric($id)) {
            return response()->json([
                'message' => 'chuỗi cú pháp sai định dạng',
                'error_code' => 4,
            ], 400);
        }

        $data = $this->ListFormRegisterRepository->DetailAccountRegister($id);

        if (! $data) {
            return response()->json([
                'message' => 'truyền tham số sai hoặc không tồn tại',
                'error_code' => 4,
            ], 400);
        }

        return response()->json([
            'data' => $data,
            'message' => ' Lấy dữ liệu thành công',
            'status' => 200,
        ], 200);
    }
}
