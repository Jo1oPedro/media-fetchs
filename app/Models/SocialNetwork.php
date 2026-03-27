<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "base_url",
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }
}
