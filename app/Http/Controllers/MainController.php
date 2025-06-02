<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $metrologicalSensors = SensorData::query()
            ->where('group', SensorData::SENSOR_GROUP_METROLOGICAL)
            ->get();

        $airQualitySensors = SensorData::query()
            ->where('group', SensorData::SENSOR_GROUP_AIR_QUALITY)
            ->get();

        return view('air-quality', [
            'metrologicalSensors' => $metrologicalSensors,
            'airQualitySensors' => $airQualitySensors,
        ]);
    }
}
