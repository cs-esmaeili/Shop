<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class warehouse_order extends Model
{
    protected $table = 'warehouse_order';
    protected $primaryKey = 'warehouse_order_id';
    protected $guarded = ['warehouse_order_id'];
    protected $fillable = ['warehouse_id', 'factor_id', 'factor_product_id', 'status', 'number', 'weight_change', 'weight_change_description'];
    protected $hidden = ['created_at', 'updated_at'];
}
