<?php

namespace App\Enums;

enum MediaStatus: string
{
    case Pending = 'pending';
    case Success = 'success';
    case Failed = 'failed';
}
