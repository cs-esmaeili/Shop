<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class intromess extends Model
{
    protected $table = 'intromess';
    protected $primaryKey = 'intromess_id';
    protected $guarded = ['intromess_id'];
    protected $fillable = ['message_id', 'VERSIONNAME', 'type', 'btn_text', 'cansel_text', 'btn_visi', 'cansel_visi', 'matn', 'image', 'url', 'can_cansel', 'save'];
    protected $hidden = ['created_at', 'updated_at', 'intromess_id'];
}
