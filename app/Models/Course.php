<?php

namespace App\Models;

use App\Enums\ColourCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'lecturer_id',
        'colour_code',
    ];

    protected $casts = [
        'colour_code' => ColourCode::class
    ];

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'course_id');
    }
}
