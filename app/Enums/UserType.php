<?php

namespace App\Enums;

enum UserType: string
{
    case Student = 'student';
    case Lecturer = 'lecturer';
    case Admin = 'admin';


    /**
     * Get an array of all the values of enums
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
