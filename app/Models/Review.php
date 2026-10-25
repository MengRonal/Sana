<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'order_id', 
        'customer_id', 
        'rating', 
        'comment'
    ];

    // 💡 កំណត់ Data Type របស់ rating ឱ្យទៅជា Integer ស្វ័យប្រវត្តិ
    protected $casts = [
        'rating' => 'integer',
    ];

    // 💡 Relationship ទៅកាន់ Model Order
    public function order() 
    { 
        return $this->belongsTo(Order::class, 'order_id', 'order_id'); 
    }

    // 💡 Relationship ទៅកាន់ Model Customer
    public function customer() 
    { 
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id'); 
    }
}