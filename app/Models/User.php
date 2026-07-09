<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
     protected $primaryKey = 'user_id'; 
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'phone',
        'username',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the role that owns the user.
     */
    public function role(): BelongsTo
    {
       
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Automatically hashes passwords on save
        ];
    }
}
