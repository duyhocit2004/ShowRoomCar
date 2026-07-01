<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LocationShowroom\ILocationShowroomServices;
use Illuminate\Http\Request;

class LocationShowroomApiController extends Controller
{
    protected ILocationShowroomServices $LocationShowroomServices;

    public function __construct(ILocationShowroomServices $LocationShowroomServices)
    {
        $this->LocationShowroomServices = $LocationShowroomServices;
    }

    public function GetListShowroom(Request $request)
    {
        return $this->LocationShowroomServices->GetListShowroom($request);
    }

    public function GetDetailShowroom(string $id)
    {
        return $this->LocationShowroomServices->GetDetailShowroom($id);
    }

    public function insertShowroom(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'City' => 'required|string|max:255',
            'phone' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ: ' . $validator->errors()->first()
            ]);
        }

        return $this->LocationShowroomServices->insertShowroom($request);
    }

    public function UpdateShowroom(Request $request, string $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'nullable|string|max:100',
            'City' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ: ' . $validator->errors()->first()
            ]);
        }

        return $this->LocationShowroomServices->UpdateShowroom($request, $id);
    }

    public function DeleteShowroom(string $id)
    {
        return $this->LocationShowroomServices->DeleteShowroom($id);
    }
}
