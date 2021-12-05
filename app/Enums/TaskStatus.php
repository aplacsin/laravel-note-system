<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self todo()
 * @method static self complete()
 */
class TaskStatus extends Enum
{
    private const TODO = 'ToDo';
    private const COMPLETE = 'Completed';

    protected static function labels(): array
    {
        return [
            'todo' => self::TODO,
            'complete' => self::COMPLETE,
        ];
    }
}
