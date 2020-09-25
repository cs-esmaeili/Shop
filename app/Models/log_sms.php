<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_sms extends Model
{
    protected $table = 'log_sms';
    protected $primaryKey = 'log_sms_id';
    protected $guarded = ['log_sms_id'];
    protected $fillable = ['sender', 'user_id' , 'phone_number' , 'text'];
}
