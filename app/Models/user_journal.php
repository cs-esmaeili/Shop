<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_journal extends Model
{
    protected $table = 'user_journal';
    protected $primaryKey = 'user_journal_id';
    protected $guarded = ['user_journal_id'];
    protected $fillable = ['user_id', 'name', 'phone_number', 'home_number', 'state', 'city', 'postal_code', 'address', 'description', 'authority_code', 'ref_id', 'done', 'datetime'];
}
