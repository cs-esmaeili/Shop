<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $guarded = ['user_id'];
    protected $fillable = ['username', 'password' , 'token' , 'ban' , 'description'];
}
