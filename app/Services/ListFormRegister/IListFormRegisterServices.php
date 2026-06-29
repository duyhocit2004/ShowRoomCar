<?php

namespace App\Services\ListFormRegister;
use Illuminate\Http\Request;
interface IListFormRegisterServices {
    public function ListAccountRegister(Request $Request);
    public function UpdateAccountRegister(string $id,Request $Request);
    public function SoftDeleteAccountRegister(Request $Request);
    public function DetailAccountRegister(string $id);
}