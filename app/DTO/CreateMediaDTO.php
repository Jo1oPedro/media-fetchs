<?php

namespace App\DTO;

class CreateMediaDTO
{
    public function __construct(
      public readonly string $originalUrl,
      public readonly string $format,
      public readonly ?string $s3Url = null,
    ) {}
}
