<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('categories')]
#[Fillable([
    'name'
])]
class CategoriesModel extends Model
{
   public function productions()
{
    return $this->hasMany(ProductionModel::class, 'category_id', 'id');
}
}
