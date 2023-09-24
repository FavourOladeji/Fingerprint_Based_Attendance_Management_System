<?php

namespace App\Models;

use App\Enums\FingerprintStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'registered_id',
        'id_to_be_registered',
        'status',
    ];

    protected $casts = [
        'status' => FingerprintStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
