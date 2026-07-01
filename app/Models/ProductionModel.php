<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('production')]
#[Fillable([
    'name',
    'title',
    'image',
    'description',
    'category_id',
    'status',
    'Year',
    'price',
    'seat'
])]
class ProductionModel extends Model
{

    public function category()
    {
        return $this->belongsTo(CategoriesModel::class, 'category_id', 'id');
    }

    public function specification()
    {
        return $this->hasOne(CarspecificationsModel::class, 'product_id', 'id');
    }

    public function albumimages()
    {
        return $this->hasMany(
            AlbumImageModel::class,
            'product_id',
            'id'
        );
    }
}
