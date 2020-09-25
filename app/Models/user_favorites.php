<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_favorites extends Model
{
    protected $table = 'user_favorites';
    protected $primaryKey = 'user_favorites_id';
    protected $guarded = ['user_favorites_id'];
    protected $fillable = ['user_id', 'product_id'];
    protected $hidden = ['created_at' , 'updated_at' ];

}
