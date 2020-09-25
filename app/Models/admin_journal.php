<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin_journal extends Model
{
    protected $table = 'admin_journal';
    protected $primaryKey = 'admin_journal_id';
    protected $guarded = ['admin_journal_id'];
    protected $fillable  = ['admin_id', 'factor_id' , 'factor_product_id' , 'warehouse_id' ,'product_id', 'number'];
}
