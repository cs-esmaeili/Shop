<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_signup extends Model
{
    protected $table = 'user_signup';
    protected $primaryKey = 'user_signup_id';
    protected $guarded = ['user_signup_id'];
    protected $fillable  = ['username', 'password' , 'token' , 'expiration' ,'sent', 'number_try'];
   // protected $hidden = ['firstpage_id' , 'product_id' , 'created_at' ,'updated_at'];
}
