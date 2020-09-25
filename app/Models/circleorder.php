<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class circleorder extends Model
{
    protected $table = 'circleorder';
    protected $primaryKey = 'circleorder_id';
    protected $guarded = ['circleorder_id'];
    protected $fillable  = ['last'];
}
