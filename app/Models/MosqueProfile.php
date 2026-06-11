<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MosqueProfile extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'email',
        'history', 'vision', 'mission', 'logo',
    ];
}