<?php

namespace App\Models;

use App\Enums\AttendanceStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
        'has_checked_out',
        'timeout',
    ];

    protected $appends = [
        'status_colour_code'
    ];

    protected $casts = [
        'status' => AttendanceStatus::class
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function statusColourCode(): Attribute
    {
        $colourCodeMap = [
            AttendanceStatus::Present->value => 'success',
            AttendanceStatus::Late->value => 'warning',
            AttendanceStatus::Absent->value => 'danger',
        ];

        return Attribute::make(
            get: function ($values, $attributes) use ($colourCodeMap) {
                return $colourCodeMap[$attributes['status']];
            }
        );
    }
}
