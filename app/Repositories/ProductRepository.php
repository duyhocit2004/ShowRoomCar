<?php

namespace App\Repositories;

use App\Models\AlbumImageModel;
use App\Models\ProductionModel;
use Cloudinary\Api\Upload\UploadApi;

class ProductRepository
{
    public function GetListProduct($Request)
    {

        return ProductionModel::with('category')
            ->when($Request->name, function ($q) use ($Request) {
                $q->where('name', 'like', '%'.$Request->name.'%');
            })
            ->when($Request->status !== null && $Request->status !== '', function ($q) use ($Request) {
                $q->where('status', $Request->status);
            })
            ->paginate(10);

    }

    public function GetListDetailProduct($id)
    {
        return ProductionModel::with([
            'category',
            'specification',
            'albumimages',
        ])->findOrFail($id);

    }

public function UpdateProduct($request, $id)
{

    $product = ProductionModel::findOrFail($id);



    // =====================
    // UPDATE THÔNG TIN PRODUCT
    // =====================

    $yearInput = $request->Year;
    if (is_numeric($yearInput) && strlen((string)$yearInput) == 4) {
        $yearInput = $yearInput . '-01-01 00:00:00';
    }

    $product->update([

        'name' => $request->name ?? $product->name,

        'title' => $request->title ?? $product->title,

        'description' => $request->description ?? $product->description,

        'category_id' => $request->category_id ?? $product->category_id,

        'status' => $request->status ?? $product->status,

        'Year' => $yearInput ?? $product->Year,

        'price' => $request->price ?? $product->price,

        'seat' => $request->seat ?? $product->seat,

    ]);





    // =====================
    // UPDATE ẢNH CHÍNH
    // =====================

    if($request->hasFile('image'))
    {


        $image = $this->uploadCloudinary(
            $request->file('image')
        );


        $product->update([

            'image'=>$image

        ]);

    }







    // =====================
    // UPDATE SPECIFICATION
    // =====================

    if($product->specification)
    {


        $product->specification()->update([


            'engine'=>$request->engine 
                ?? $product->specification->engine,


            'horsepower'=>$request->horsepower
                ?? $product->specification->horsepower,


            'torque'=>$request->torque
                ?? $product->specification->torque,


            'fuel_consumption'=>$request->fuel_consumption
                ?? $product->specification->fuel_consumption,


            'acceleration'=>$request->acceleration
                ?? $product->specification->acceleration,


            'top_speed'=>$request->top_speed
                ?? $product->specification->top_speed,


            'safety_rating'=>$request->safety_rating
                ?? $product->specification->safety_rating,


            'warranty_info'=>$request->warranty_info
                ?? $product->specification->warranty_info,


            'transmission'=>$request->transmission
                ?? $product->specification->transmission,


            'length'=>$request->length
                ?? $product->specification->length,


            'width'=>$request->width
                ?? $product->specification->width,


            'height'=>$request->height
                ?? $product->specification->height,


            'wheelbase'=>$request->wheelbase
                ?? $product->specification->wheelbase,


            'weight'=>$request->weight
                ?? $product->specification->weight,


            'fuel_tank_capacity'=>$request->fuel_tank_capacity
                ?? $product->specification->fuel_tank_capacity,


        ]);

    }







    // =====================
    // THÊM ẢNH ALBUM
    // =====================

    if($request->hasFile('album'))
    {


        foreach($request->file('album') as $file)
        {


            $image = $this->uploadCloudinary($file);



            AlbumImageModel::create([

                'product_id'=>$product->id,

                'image'=>$image

            ]);

        }

    }





    return response()->json([

        'status'=>true,

        'message'=>'Cập nhật sản phẩm thành công',

        'data'=>$product->load([
            'category',
            'specification',
            'albumimages'
        ])

    ]);

}

    public function insertProduct($Request)
    {
        $image = null;
        if($Request->hasFile('image')) {
            $image = $this->uploadCloudinary($Request->file('image'));
        }

        $yearInput = $Request->Year;
        if (is_numeric($yearInput) && strlen((string)$yearInput) == 4) {
            $yearInput = $yearInput . '-01-01 00:00:00';
        }

        $product = ProductionModel::create([
            'name' => $Request->name,
            'title' => $Request->title,
            'description' => $Request->description,
            'category_id' => $Request->category_id,
            'status' => $Request->status ?? 'active',
            'Year' => $yearInput,
            'price' => $Request->price,
            'seat' => $Request->seat,
            'image' => $image,
        ]);

        $product->specification()->create([
            'engine' => $Request->engine,
            'horsepower' => $Request->horsepower,
            'torque' => $Request->torque,
            'fuel_consumption' => $Request->fuel_consumption,
            'acceleration' => $Request->acceleration,
            'top_speed' => $Request->top_speed,
            'safety_rating' => $Request->safety_rating,
            'warranty_info' => $Request->warranty_info,
            'transmission' => $Request->transmission,
            'length' => $Request->length,
            'width' => $Request->width,
            'height' => $Request->height,
            'wheelbase' => $Request->wheelbase,
            'weight' => $Request->weight,
            'fuel_tank_capacity' => $Request->fuel_tank_capacity,
        ]);

        if($Request->hasFile('album')) {
            foreach($Request->file('album') as $file) {
                $img = $this->uploadCloudinary($file);
                AlbumImageModel::create([
                    'product_id' => $product->id,
                    'image' => $img
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Thêm sản phẩm thành công',
            'data' => $product->load(['category', 'specification', 'albumimages'])
        ]);
    }

    public function Deleteproduct($id)
    {
        $product = ProductionModel::findOrFail($id);
        
        $product->albumimages()->delete();
        if ($product->specification) {
            $product->specification()->delete();
        }
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }

    public function DeleteAlbumImage($id)
    {

        $image = AlbumImageModel::findOrFail($id);

        $image->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa ảnh thành công',
        ]);
    }

    private function uploadCloudinary($file)
    {
        \Cloudinary\Configuration\Configuration::instance([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        $result =
        (new UploadApi)
            ->upload(
                $file->getRealPath(),
                [
                    'folder' => 'products',
                ]
            );

        return $result['secure_url'];

    }
}
