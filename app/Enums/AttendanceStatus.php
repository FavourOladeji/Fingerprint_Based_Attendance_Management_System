<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    case Late = 'late';
    case Present = 'present';
    case Absent = 'absent';
}
