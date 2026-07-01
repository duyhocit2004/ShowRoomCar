<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'status',
    ];
}
