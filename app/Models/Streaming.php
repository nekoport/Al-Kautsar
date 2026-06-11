<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streaming extends Model
{
    protected $fillable = [
        'title', 'youtube_url', 'is_live', 'scheduled_at',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'is_live' => 'boolean',
            'scheduled_at' => 'datetime',
        ];
    }
}
