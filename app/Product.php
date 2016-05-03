<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['model_id', 'name', 'subtitle', "origin_price", "demestic_price", "retail_price", "wholesale_price", "count", "thumbnail", "detail_image", "category_id", "brand_id", "description", "created_at"];

    protected $dates = ['deleted_at'];
}
