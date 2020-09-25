<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courier_task extends Model
{
    protected $table = 'courier_task';
    protected $primaryKey = 'courier_task_id';
    protected $guarded = ['courier_task_id'];
    protected $fillable = ['courier_id', 'factor_id', 'factor_product_id', 'warehouse_id', 'datetime_receive', 'datetime_delivery'];
    protected $hidden = ['created_at', 'updated_at'];
}
