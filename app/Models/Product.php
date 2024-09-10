<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use \App\Traits\StoreScope;


    protected $fillable = [
        'name',
        'description',
        'category_id',
        'store_id',
        'price',
    ];


}
