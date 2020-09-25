<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $guarded = ['admin_id'];
    protected $fillable  = ['username', 'password' , 'token' , 'enabel' , 'online' ,'order_come'];



}
