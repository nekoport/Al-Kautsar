<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt',
        'thumbnail', 'category_id', 'user_id', 'published_at',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $slug = Str::slug($post->title);
                $count = static::where('slug', 'LIKE', "{$slug}%")->count();
                $post->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
