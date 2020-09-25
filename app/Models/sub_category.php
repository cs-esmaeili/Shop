<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    protected $table = 'sub_category';
    protected $primaryKey = 'sub_category_id';
    protected $guarded = ['sub_category_id'];
    protected $fillable = ['main_category_id', 'category' , 'title' , 'image'];
    protected $hidden = [ 'created_at' ,'updated_at'];
}
