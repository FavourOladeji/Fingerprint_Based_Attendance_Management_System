<?php

namespace App\Enums;

enum DeviceMode: string
{
    case Enrollment = 'enrollment';
    case Attendance = 'attendance';

    /**
     * Get an array of all the values of enums
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
