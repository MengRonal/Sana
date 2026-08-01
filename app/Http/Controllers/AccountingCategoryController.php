<?php

namespace App\Models;

use App\Models\InAndExpType;
use Illuminate\Database\Eloquent\Model;

class AccountingCategory extends Model
{
    protected $table = 'accounting_category';

    protected $fillable = ['name', 'id_type'];

    public function type()
    {
        return $this->belongsTo(InAndExpType::class, 'id_type', 'id_type');
    }

    public function transactions()
    {
        return $this->hasMany(CashTransaction::class, 'category_id');
    }
}