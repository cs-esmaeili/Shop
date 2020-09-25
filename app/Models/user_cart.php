<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_cart extends Model
{
    protected $table = 'user_cart';
    protected $primaryKey = 'user_cart_id';
    protected $guarded = ['user_cart_id'];
    protected $fillable = ['user_id', 'product_id' , 'number'];
}
