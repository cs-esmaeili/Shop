<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_message extends Model
{
    protected $table = 'user_message';
    protected $primaryKey = 'user_message_id';
    protected $guarded = ['user_message_id'];
    protected $fillable  = ['user_id', 'text'];
}
