<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Costumer extends Model
{
    protected $table = 'customer';
    public $timestamps = false;
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'user_id','name','phone'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
