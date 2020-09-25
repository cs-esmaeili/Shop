<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class card_information extends Model
{
    protected $table = 'card_information';
    protected $primaryKey = 'card_information_id';
    protected $guarded = ['card_information_id'];
    protected $fillable  = ['user_id' , 'number' , 'name'];
}
