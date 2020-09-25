<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_journal_product extends Model
{
    protected $table = 'user_journal_product';
    protected $primaryKey = 'user_journal_product_id';
    protected $guarded = ['user_journal_product_id'];
    protected $fillable  = ['user_journal_id', 'product_id' , 'number' , 'price' ,'old_price'];
}
