<?php

namespace App\DTO;

use App\Models\Media;

class MediaDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $status,
        public readonly ?string $platform,
        public readonly ?string $format,
        public readonly ?string $original_url,
        public readonly ?string $s3_url,
    ) {}

    public static function fromModel(Media $media): self
    {
        return new self(
            id: $media->id,
            status: $media->status ?? 'pending',
            platform: $media->socialNetwork?->slug,
            format: $media->format,
            original_url: $media->original_url,
            s3_url: $media->s3_url,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'platform' => $this->platform,
            'format' => $this->format,
            'original_url' => $this->original_url,
            's3_url' => $this->s3_url,
        ];
    }
}
