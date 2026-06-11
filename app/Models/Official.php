<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    protected $fillable = [
        'name', 'position', 'photo', 'bio',
        'order', 'is_active',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }
}