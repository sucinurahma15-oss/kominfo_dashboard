<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMediaStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_media_account_id',
        'followers',
        'following',
        'posts_count',
        'engagement',
        'engagement_rate',
        'record_date'
    ];

    protected $casts = [
        'record_date' => 'date',
        'engagement_rate' => 'decimal:2'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(SocialMediaAccount::class, 'social_media_account_id');
    }
}