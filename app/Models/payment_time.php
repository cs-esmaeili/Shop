<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment_time extends Model
{
    protected $table = 'payment_time';
    protected $primaryKey = 'payment_time_id';
    protected $guarded = ['payment_time_id'];
    protected $hidden = [ 'created_at' ,'updated_at'];
}
