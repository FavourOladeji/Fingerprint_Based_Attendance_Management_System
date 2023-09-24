<?php

namespace App\Models;

use App\Enums\DeviceMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'uid',
        'mode'
    ];

    protected $casts = [
        'mode' => DeviceMode::class
    ];

    /**
     * @return HasMany
     */
    public function fingerprint(): HasMany
    {
        return $this->hasMany(Fingerprint::class);
    }
}
