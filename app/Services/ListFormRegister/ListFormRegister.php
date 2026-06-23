<?php

namespace App\Serive\ListFormRegister;

use App\Serives\ListFormRegister\IListFormRegister;
use Illuminate\Support\Facades\Response;

class ListFormRegister implements IListFormRegister
{
    public function ListAccountRegister(Response $response) {}

    public function UpdateAccountRegister(string $id, Response $response) {}

    public function SoftDeleteAccountRegister(Response $response) {}

    public function DetailAccountRegister(string $id) {}
}
