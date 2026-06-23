<?php

namespace App\Serives\ListFormRegister;
use Illuminate\Support\Facades\Response;
interface IListFormRegister {
    public function ListAccountRegister(Response $response);
    public function UpdateAccountRegister(string $id,Response $response);
    public function SoftDeleteAccountRegister(Response $response);
    public function DetailAccountRegister(string $id);
}