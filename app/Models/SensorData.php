<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'last_updated_at' => 'datetime',
    ];

    const SENSOR_GROUP_METROLOGICAL = 'metrological';
    const SENSOR_GROUP_AIR_QUALITY = 'air-quality';
}
