<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment_date extends Model
{
    protected $table = 'payment_date';
    protected $primaryKey = 'payment_date_id';
    protected $guarded = ['payment_date_id'];
    protected $hidden = [ 'created_at' ,'updated_at'];
}
