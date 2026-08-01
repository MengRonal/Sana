<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable=[
        'supplier_id',
        'user_id',
        'product_id',
        'quantity',
        'cost_price'
    ];
}