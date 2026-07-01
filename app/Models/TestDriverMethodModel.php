<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name','status'])]
#[Table('testdrivemethod')]
class TestDriverMethodModel extends Model
{
    public function TestDriverRequest(){
        return $this->hasMany(TestDriverRequestModel::class,'testDriveMethod_id','id');
    }
}
