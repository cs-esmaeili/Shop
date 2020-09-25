<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class factor extends Model
{
    protected $table = 'factor';
    protected $primaryKey = 'factor_id';
    protected $guarded = ['factor_id'];
    protected $fillable = ['user_id','admin_id', 'name', 'phone_number', 'home_number','status', 'state', 'city', 'postal_code', 'address' , 'description', 'ref_id' , 'datetime' , 'rate' , 'total_Price' , 'difference_status'];
}
