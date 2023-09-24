<?php

namespace App\Enums;

enum FingerprintStatus: string
{
    case Added = 'added';
    case Pending = 'pending';
    case Deleted = 'deleted';
}
