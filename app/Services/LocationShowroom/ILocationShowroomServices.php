<?php

namespace App\Services\LocationShowroom;

use Illuminate\Http\Request;

interface ILocationShowroomServices {
    public function GetListShowroom(Request $Request);
    public function GetDetailShowroom(string $id);
    public function insertShowroom(Request $Request);
    public function UpdateShowroom(Request $Request, string $id);
    public function DeleteShowroom(string $id);
}
