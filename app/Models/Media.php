<?php

namespace App\Models;

use App\Enums\MediaStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "social_network_id",
        "original_url",
        "s3_url",
        "status",
        "format",
    ];

    protected function casts(): array
    {
        return [
            'status' => MediaStatus::class,
        ];
    }

    public function socialNetwork(): BelongsTo
    {
        return $this->belongsTo(SocialNetwork::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
