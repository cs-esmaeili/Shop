<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';
    protected $guarded = ['warehouse_id'];
    protected $fillable  = ['username', 'password' , 'token' , 'name' ,'warehouse_keeper_name', 'address' , 'phonenumber'];
    protected $hidden = ['created_at' , 'updated_at'];
}
