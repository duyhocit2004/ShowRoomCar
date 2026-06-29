<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name','phone','email','car','dateTest','testDriveMethod_id','note','created_at','updated_at'])]
#[Table('testdriverequests')]
class TestDriverRequestModel extends Model
{
    
    public function TestDriverMethod(){
        return $this->belongsTo(TestDriverMethodModel::class,'testDriveMethod_id','id');
        
    }
}
