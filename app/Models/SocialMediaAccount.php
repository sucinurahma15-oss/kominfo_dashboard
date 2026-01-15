<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialMediaAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'account_name',
        'account_url',
        'account_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function statistics(): HasMany
    {
        return $this->hasMany(SocialMediaStatistic::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(SocialMediaPost::class);
    }

    public function latestStatistic()
    {
        return $this->hasOne(SocialMediaStatistic::class)->latestOfMany('record_date');
    }
}