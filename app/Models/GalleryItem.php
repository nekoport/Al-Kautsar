<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'gallery_id', 'image_path', 'caption', 'order',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
