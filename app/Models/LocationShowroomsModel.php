<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('locationshowrooms')]
#[Fillable([
    'City',
    'name',
    'table',
    'Opening hours',
    'phone',
    'ShowroomArea',
    'location',
    'has_test_drive',
    'has_service',
    'has_parking',
    'has_accessories',
    'has_insurance',
    'has_body_paint',
    'status',
    'locationOnGoogle',
])]
class LocationShowroomsModel extends Model
{
    //
}
