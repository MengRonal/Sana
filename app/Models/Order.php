<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\OrderType;
use App\Models\PaymentMethod;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    // No created_at / updated_at columns shown in the diagram
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'cashier_id',
        'order_type_id',
        'waiting_num',
        'total_amount',
        'discount',
        'final_price',
        'exchange_rate',
        'payment_method_id',
        'is_paid',
        'payment_status',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // cashier is a "users" record
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id', 'user_id');
    }

    public function orderType()
    {
        return $this->belongsTo(OrderType::class, 'order_type_id', 'order_type_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'order_id', 'order_id');
    }
}