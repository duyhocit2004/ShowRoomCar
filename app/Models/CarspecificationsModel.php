<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('carspecifications')]
#[Fillable([
     'product_id',
    'engine',
    'horsepower',
    'torque',
    'fuel_consumption',
    'acceleration',
    'top_speed',
    'safety_rating',
    'warranty_info',
    'transmission',
    'length',
    'width',
    'height',
    'wheelbase',
    'weight',
    'fuel_tank_capacity',
])]
class CarspecificationsModel extends Model
{
   public function product()
{
    return $this->belongsTo(ProductionModel::class, 'product_id', 'id');
}
}
