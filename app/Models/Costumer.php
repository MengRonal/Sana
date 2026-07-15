<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'user_id','name','phone'
    ];
}
