<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class factor_product extends Model
{
    use SoftDeletes;
    protected $table = 'factor_product';
    protected $primaryKey = 'factor_product_id';
    protected $guarded = ['factor_product_id'];
    protected $fillable = ['factor_id', 'product_id', 'number', 'price', 'old_price', 'weight' ,'status', 'payment', 'payment_weight_change'];
}
