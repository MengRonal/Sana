<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    protected $table = 'Settings';

    protected $fillable = [
        'shop_name',
        'logo',
        'address',
        'tel',
        'exchange_rate'
    ];

    public $timestamps = false;
}
