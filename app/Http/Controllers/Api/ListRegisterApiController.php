<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ListFormRegister\ListFormRegisterServices;
class ListRegisterApiController extends Controller
{
     protected $ListRegisterController ;
     public function __construct( ListFormRegisterServices $ListRegisterController)
    {
        $this->ListRegisterController = $ListRegisterController;
    }

     public function ListAccountRegister(Request $Request){
        return $this->ListRegisterController->ListAccountRegister($Request);
     }
    public function UpdateAccountRegister(string $id,Request $Request){
       return $this->ListRegisterController->UpdateAccountRegister($id,$Request);
    }
    public function SoftDeleteAccountRegister(Request $Request){
       return $this->ListRegisterController->SoftDeleteAccountRegister($Request);
    }
    public function DetailAccountRegister(string $id){
       return $this->ListRegisterController-> DetailAccountRegister($id);
    }
}
