<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class factor_edite extends Model
{
    protected $table = 'factor_edite';
    protected $primaryKey = 'factor_edite_id';
    protected $guarded = ['factor_edite_id'];
    protected $fillable = ['factor_id', 'factor_product_id', 'product_id', 'number', 'price', 'old_price', 'weight', 'payment', 'payment_weight_change', 'new_number'];


}
