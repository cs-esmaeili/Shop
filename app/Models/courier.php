<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courier extends Model
{
    protected $table = 'courier';
    protected $primaryKey = 'courier_id';
    protected $guarded = ['courier_id'];
    protected $fillable  = ['username', 'password','token' , 'name' , 'family' ,'phonenumber', 'plaque' , 'level'];
}
