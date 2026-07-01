<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Product\IProductServices;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    protected IProductServices $ProductServices;

    public function __construct(IProductServices $ProductServices)
    {
        $this->ProductServices = $ProductServices;
    }

    public function GetListProduct(Request $request)
    {
        return $this->ProductServices->GetListProduct($request);
    }

    public function GetListDetailProduct(string $id)
    {
        return $this->ProductServices->GetListDetailProduct($id);
    }

    public function insertProduct(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string',
            'title' => 'required|string',
            'price' => 'nullable|numeric',
            'Year' => 'nullable|date',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'wheelbase' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'fuel_tank_capacity' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Dữ liệu không hợp lệ: ' . $validator->errors()->first()
            ]);
        }

        return $this->ProductServices->insertProduct($request);
    }

    public function UpdateProduct(Request $request, string $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'price' => 'nullable|numeric',
            'Year' => 'nullable|date',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'wheelbase' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'fuel_tank_capacity' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Dữ liệu không hợp lệ: ' . $validator->errors()->first()
            ]);
        }

        return $this->ProductServices->UpdateProduct($request, $id);
    }

    public function DeleteProduct(string $id)
    {
        return $this->ProductServices->Deleteproduct($id);
    }

     public function DeleteAlbumImage(string $id)
    {
        return $this->ProductServices->DeleteAlbumImage($id);
    }

    public function GetAllCategories()
    {
        return response()->json([
            'status' => true,
            'data' => \App\Models\CategoriesModel::all()
        ]);
    }
}
