<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'count', 'price', "type", "info"];
}
