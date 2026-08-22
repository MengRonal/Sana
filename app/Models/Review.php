<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Order;
class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    protected $fillable = ['order_id', 'customer_id', 'rating', 'comment'];

    public function order() { return $this->belongsTo(Order::class, 'order_id', 'order_id'); }
    public function customer() { return $this->belongsTo(Customer::class, 'customer_id', 'customer_id'); }
}