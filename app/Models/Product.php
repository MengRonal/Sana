<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product'; // ប្រាប់ឈ្មោះ table ទៅកាន់ model
    protected $primaryKey = 'product_id'; // ដោយសារអ្នកប្រើ product_id ជា PK (មិនមែន id ធម្មតា)

        public $timestamps = false;
    protected $fillable = [
        'product_name',
        'category_id',
        'supplier_id',
        'price',
        'qty',
        'product_type',
        'image',
        'description',
        'status'
    ];
}