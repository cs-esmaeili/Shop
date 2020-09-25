<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class view extends Model
{
    protected $table = 'view';
    protected $primaryKey = 'view_id';
    protected $guarded = ['view_id'];
    protected $fillable = ['day', 'location'];
}
