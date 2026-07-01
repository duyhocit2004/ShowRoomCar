<?php

namespace App\Repositories;

use App\Models\TestDriverMethodModel;
use Illuminate\Http\Request;

class TestDriverMethodRepository {
    public function GetListMethodTest($Request)
{
    $query = TestDriverMethodModel::query();

    // Tìm kiếm theo tên
    if ($Request->filled('search')) {
        $query->where('name', 'like', '%' . trim($Request->search) . '%');
    }

    // Lọc theo trạng thái (nếu truyền)
    if ($Request->filled('status')) {
        $query->where('status', $Request->status);
    }

    $perPage = $Request->get('per_page', 10);

    return $query->orderByDesc('id')->paginate($perPage);
}

    public function GetListDetailMethodTest($id)
    {
        return TestDriverMethodModel::find($id);
    }

    public function UpdateListMethodTest($Request, $id)
    {
        $method = TestDriverMethodModel::find($id);

        if (!$method) {
            return null;
        }

        $method->update([
            'name'   => $Request->name,
            'status' => $Request->status,
        ]);

        return $method->fresh();
    }

    public function insertMethodTest($Request)
    {
        return TestDriverMethodModel::create([
            'name'   => $Request->name,
            'status' => $Request->status,
        ]);
    }

    public function DeleteMethodTest($id)
    {
        $method = TestDriverMethodModel::find($id);

        if (!$method) {
            return false;
        }

        return $method->delete();
    }
}
