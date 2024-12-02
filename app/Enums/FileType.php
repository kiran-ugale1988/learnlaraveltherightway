<?php

declare(strict_types=1);

namespace App\Enums;

enum FileType: string {
    case Receipt = 'receipt';
    case Statement = 'statement';
}

