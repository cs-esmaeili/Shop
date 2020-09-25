<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class weight_transactions extends Model
{
    use SoftDeletes;
    protected $table = 'weight_transactions';
    protected $primaryKey = 'weight_transactions_id';
    protected $guarded = ['weight_transactions_id'];
    protected $fillable = ['factor_id', 'weight_price', 'authority_code' , 'ref_id'];

}
