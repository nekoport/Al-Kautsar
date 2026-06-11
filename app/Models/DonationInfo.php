<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DonationInfo extends Model
{
    protected $table = 'donation_info';

    protected $fillable = [
        'type', 'bank_name', 'account_number', 'account_name',
        'qris_image', 'notes',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeBank(Builder $query): Builder
    {
        return $query->where('type', 'bank');
    }

    public function scopeQris(Builder $query): Builder
    {
        return $query->where('type', 'qris');
    }
}