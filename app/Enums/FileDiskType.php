<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self public()
 * @method static self s3()
 */
class FileDiskType extends Enum
{
    private const PUBLIC = 'public';
    private const S3 = 's3';

    protected static function labels(): array
    {
        return [
            'public' => self::PUBLIC,
            's3' => self::S3,
        ];
    }
}
