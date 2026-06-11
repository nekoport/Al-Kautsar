<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'album_name', 'description', 'cover_image',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function items()
    {
        return $this->hasMany(GalleryItem::class);
    }
}
