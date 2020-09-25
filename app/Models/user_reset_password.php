<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_reset_password extends Model
{
    protected $table = 'user_reset_password';
    protected $primaryKey = 'user_reset_password_id';
    protected $guarded = ['user_reset_password_id'];
    protected $fillable = ['username', 'token', 'expiration', 'sent', 'number_try'];
}
