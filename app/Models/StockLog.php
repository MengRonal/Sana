<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    // កំណត់ Table Name ប្រសិនបើឈ្មោះ table ក្នុង DB ជា stock_logs
    protected $table = 'stock_logs';

    // Column ទាំងឡាយណាដែលអនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យបាន (Mass Assignment)
    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'unit_cost',
        'reference_type',
        'reference_id',
        'note',
        'user_id',
    ];

    // Relationship ទៅកាន់ Table Product (មួយ Log ជា Restock/Sales របស់ Product មួយ)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relationship ទៅកាន់ Table User (អ្នកណាជាអ្នកប្រព្រឹត្ត Log នេះ)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}