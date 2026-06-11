<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'description', 'location',
        'start_date', 'end_date', 'is_active',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Event $event) {
            if (empty($event->slug)) {
                $slug = Str::slug($event->title);
                $count = static::where('slug', 'LIKE', "{$slug}%")->count();
                $event->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }
}
