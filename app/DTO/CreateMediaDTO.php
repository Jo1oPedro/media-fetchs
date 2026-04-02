<?php

namespace App\DTO;

use App\Enums\MediaStatus;

class CreateMediaDTO
{
    public function __construct(
        public readonly string $originalUrl,
        public readonly string $format,
        public readonly ?string $s3Url = null,
        public readonly ?string $status = MediaStatus::Pending->value,
    ) {}
}
