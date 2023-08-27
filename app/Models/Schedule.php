<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    public static $days = ['Monday', 'Tudesday', 'Wednesday', 'Thursday', 'Friday'];

    protected $fillable = [
        'time',
        'course_id',
        'day',
    ];

    protected $casts = [
        'time' => 'timestamp: H:i',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public static function getHours()
    {
        $hours = [
            'nine' => Carbon::parse('09:00 AM')->format('H:i:s'),
            'ten' => Carbon::parse('10:00 AM')->format('H:i:s'),
            'eleven' => Carbon::parse('11:00 AM')->format('H:i:s'),
            'twelve' => Carbon::parse('12:00 PM')->format('H:i:s'),
            'thirteen' => Carbon::parse('13:00')->format('H:i:s'),
        ];
        return $hours;
    }
}
