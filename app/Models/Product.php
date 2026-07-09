<?php

namespace App\Models;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

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

    public $timestamps = false;

   public function category()
{
    return $this->belongsTo(Category::class,'category_id','category_id');
}

public function supplier()
{
    return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
}
}