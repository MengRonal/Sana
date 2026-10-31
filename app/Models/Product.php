<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Supplier;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'product_id';

    public $timestamps = false; 

    protected $fillable = [
        'product_name',
        'category_id',
        'supplier_id',
        'price',
        'cost',          // <-- បន្ថែម cost សម្រាប់តម្លៃដើមទុន
        'qty',
        'product_type',
        'image',
        'description',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost'  => 'decimal:2',  // <-- បន្ថែម casts សម្រាប់ cost
        'qty'   => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}