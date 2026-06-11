<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationInfo extends Model
{
    protected $fillable = [
        'bank_name', 'account_number', 'account_name',
        'qris_image', 'notes',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}