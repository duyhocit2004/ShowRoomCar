<?php

namespace App\Services\Product;

use Illuminate\Http\Request;


interface IProductServices {
    public function GetListProduct(Request $Request);
    public function GetListDetailProduct(string $id);
    public function UpdateProduct(Request $Request,string $id);
    public function insertProduct(Request $Request);
    public function DeleteProduct(string $id);
         public function DeleteAlbumImage(string $id);
   
}