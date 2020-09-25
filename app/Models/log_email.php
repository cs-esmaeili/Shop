<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_email extends Model
{
    protected $table = 'log_email';
    protected $primaryKey = 'log_email_id';
    protected $guarded = ['log_email_id'];
    protected $fillable = ['sender', 'user_id' , 'target_email' , 'text'];
}
