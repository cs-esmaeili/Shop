<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_admin extends Model
{
    protected $table = 'log_admin';
    protected $primaryKey = 'log_admin_id';
    protected $guarded = ['log_admin_id'];
    protected $fillable = ['admin_id', 'description'];
    protected $hidden = ['created_at', 'updated_at'];
}
