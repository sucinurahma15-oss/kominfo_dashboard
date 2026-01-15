<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMediaPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_media_account_id',
        'post_id',
        'content',
        'post_url',
        'likes',
        'comments',
        'shares',
        'views',
        'posted_at'
    ];

    protected $casts = [
        'posted_at' => 'datetime'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(SocialMediaAccount::class, 'social_media_account_id');
    }

    public function getTotalEngagementAttribute(): int
    {
        return $this->likes + $this->comments + $this->shares;
    }
}