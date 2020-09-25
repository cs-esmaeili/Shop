<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class firstpage extends Model
{
    protected $table = 'firstpage';
    protected $primaryKey = 'firstpage_id';
    protected $guarded = ['firstpage_id'];
    protected $fillable = ['product_id', 'post_image' , 'url' , 'sub_categori', 'name_subcategori', 'location'];
    protected $hidden = ['firstpage_id' , 'created_at' ,'updated_at'];

}

