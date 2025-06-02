<?php

namespace App\Console\Commands;

use App\Jobs\UpdateSensorDataJob;
use App\Models\SensorData;
use Illuminate\Console\Command;

class UpdateSensors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-sensors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets latest sensor data from Cloud Studio API and updates the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $endpoints = [
            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-tint',
                'unit' => '%RH',
                'name' => 'Humidity',
                'endpoint_id' => '122263',
            ],
            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-thermometer-half',
                'unit' => '°C',
                'name' => 'Temperature',
                'endpoint_id' => '122262',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-sun',
                'unit' => '',
                'name' => 'UX Index',
                'endpoint_id' => '122265',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-lightbulb',
                'unit' => 'Lux',
                'name' => 'Light Intensity',
                'endpoint_id' => '122264',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-wind',
                'unit' => 'm/s',
                'name' => 'Wind Speed',
                'endpoint_id' => '122266',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-compass',
                'unit' => '°',
                'name' => 'Wind Direction',
                'endpoint_id' => '122267',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-cloud-rain',
                'unit' => 'mm/h',
                'name' => 'Rainfall',
                'endpoint_id' => '122268',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_METROLOGICAL,
                'icon' => 'fa-tachometer-alt',
                'unit' => 'hPa',
                'name' => 'Barometric Pressure',
                'endpoint_id' => '122269',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-vial',
                'unit' => 'ppb',
                'name' => 'H₂S',
                'endpoint_id' => '122301',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-smog',
                'unit' => 'ppb',
                'name' => 'NO₂',
                'endpoint_id' => '122313',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-industry',
                'unit' => 'ppb',
                'name' => 'SO₂',
                'endpoint_id' => '122315',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-cloud',
                'unit' => 'ppm',
                'name' => 'CO₂',
                'endpoint_id' => '122305',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-fire',
                'unit' => 'ppm',
                'name' => 'CO',
                'endpoint_id' => '',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-circle-notch',
                'unit' => 'ppb',
                'name' => 'O₃',
                'endpoint_id' => '122309',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-flask',
                'unit' => 'ppm',
                'name' => 'HCHO',
                'endpoint_id' => '122308',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-asterisk',
                'unit' => 'µg/m³',
                'name' => 'PM2.5',
                'endpoint_id' => '122306',
            ],

            [
                'group' => SensorData::SENSOR_GROUP_AIR_QUALITY,
                'icon' => 'fa-cloud-meatball',
                'unit' => 'µg/m³',
                'name' => 'PM10',
                'endpoint_id' => '122307',
            ],

        ];

        foreach ($endpoints as $endpoint) {

            UpdateSensorDataJob::dispatch($endpoint['name'], $endpoint['endpoint_id'], $endpoint['icon'], $endpoint['unit'],  $endpoint['group']);
        }

        $this->output->success('Sensor data updated successfully.');

    }
}
