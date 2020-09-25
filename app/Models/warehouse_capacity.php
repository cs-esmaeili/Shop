<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class warehouse_capacity extends Model
{
    protected $table = 'warehouse_capacity';
    protected $primaryKey = 'warehouse_capacity_id';
    protected $guarded = ['warehouse_capacity_id'];
    protected $fillable = ['warehouse_id', 'product_id', 'number'];
}
