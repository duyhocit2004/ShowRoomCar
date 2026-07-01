<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;
use App\Repositories\TestDriverMethodRepository;
use Illuminate\Http\Request;

class ProductServices implements IProductServices
{
   protected ProductRepository $ProductRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function GetListProduct(Request $Request)
    {
        return $this->ProductRepository->GetListProduct($Request);
    }

    public function GetListDetailProduct(string $id)
    {
        return $this->ProductRepository->GetListDetailProduct($id);
    }

    public function UpdateProduct(Request $Request, string $id)
    {
        return $this->ProductRepository->UpdateProduct($Request, $id);
    }

    public function insertProduct(Request $Request)
    {
        return $this->ProductRepository->insertProduct($Request);
    }

    public function DeleteProduct(string $id)
    {
        return $this->ProductRepository->Deleteproduct($id);
    } 

        public function DeleteAlbumImage(string $id)
    {
        return $this->ProductRepository->DeleteAlbumImage($id);
    }

}
