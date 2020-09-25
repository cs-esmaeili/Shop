<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $guarded = ['product_id'];
    protected $fillable = ['name', 'price', 'old_price', 'special_price', 'datetime' , 'status' ,'category','stock' , 'order_number','barcode','description' , 'weight' ,'image_folder' , 'image_thumbnail' , 'barcode' , 'weight' , 'atcw' ];
    protected $hidden = ['created_at' , 'updated_at'  ];
}
