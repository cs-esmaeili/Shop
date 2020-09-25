<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_address extends Model
{
    protected $table = 'user_address';
    protected $primaryKey = 'user_address_id';
    protected $guarded = ['user_address_id'];
    protected $fillable = ['user_id', 'name', 'home_number', 'phone_number', 'state', 'city', 'postal_code', 'address'];
    protected $hidden = ['user_id' , 'created_at' , 'updated_at' ];
}
