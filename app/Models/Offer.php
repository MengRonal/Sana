<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Offer extends Model
{
    // ប្រកាសសោចម្បងឱ្យត្រូវនឹង Database របស់អ្នក
    protected $primaryKey = 'offer_id'; 

    // បើកសិទ្ធិឱ្យបញ្ចូលទិន្នន័យ
    protected $fillable = [
        'product_id',
        'discount',
        'new_price',
        'start_date',
        'end_date',
    ];

    // បង្កើតការភ្ជាប់ទំនាក់ទំនងទៅតារាង Product 
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
