<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
#[Table('albumimages')]
#[Fillable([
    'product_id',
    'image'
])]
class AlbumImageModel extends Model
{
       public function product()
    {
        return $this->belongsTo(
            ProductionModel::class,
            'product_id',
            'id'
        );
    }
}
