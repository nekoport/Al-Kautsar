<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MosqueProfile extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'email',
        'history', 'vision', 'mission', 'logo',
        'hero_image', 'favicon', 'footer_text',
        'latitude', 'longitude',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}