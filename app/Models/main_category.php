<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class main_category extends Model
{
    protected $table = 'main_category';
    protected $primaryKey = 'main_category_id';
    protected $guarded = ['main_category_id'];
    protected $fillable = ['category', 'category_index' , 'firstpage' , 'firstpage_index', 'title', 'image'];
    protected $hidden = [ 'created_at' ,'updated_at'];

}
