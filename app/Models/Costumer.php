<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    protected $table = 'customer';   // <-- បន្ទាត់នេះខ្វះពីមុន (សំខាន់បំផុត!)

    public $timestamps = false;
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'user_id','name','phone'
    ];
}
