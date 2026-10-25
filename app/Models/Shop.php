<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shop';

    protected $fillable = [
        'shop_name',
        'logo',
        'address',
        'tel',
        'exchange_rate'
    ];

    public $timestamps = false;
}
    