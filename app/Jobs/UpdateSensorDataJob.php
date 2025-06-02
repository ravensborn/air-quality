<?php

namespace App\Jobs;

use App\Models\SensorData;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateSensorDataJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private $name = 'Generic Sensor', private $endpointId, private $icon = '', private $unit = '', private $group)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sensorData = SensorData::firstOrCreate(
            ['endpoint_id' => $this->endpointId],
            [
                'group' => $this->group,
                'icon' => $this->icon,
                'unit' => $this->unit,
                'name' => $this->name,
                'value' => 0,
                'last_updated_at' => Carbon::create(1997, 4, 20)->toIso8601String(),
                'sequence_number' => 0,
            ]
        );

        $url = "https://iot.teknykar.com/api/v2/endpointData/incremental/" . $sensorData->sequence_number;
        $params = [
            'endpointID' => $this->endpointId,
            'maxCount' => 500,
        ];

        try {

            $response = Http::withToken(config('services.teknykar.token'))
                ->get($url, $params);

            if ($response->failed()) {
                Log::error('Failed to fetch data', [
                    'status' => $response->status(),
                    'url' => $url,
                    'params' => $params,
                    'response' => $response->body()
                ]);
            }

            if ($response->successful()) {
                $data = collect($response->json())
                    ->sortByDesc('SequenceNumber')
                    ->first();

                if ($data) {
                    $sensorData->update([
                        'value' => $data['Value'],
                        'last_updated_at' => $data['Timestamp_UTC'],
                        'sequence_number' => $data['SequenceNumber']
                    ]);
                }
            }


        } catch (\Exception $e) {
            Log::error('Exception occurred while fetching sensor data', [
                'message' => $e->getMessage(),
                'url' => $url,
                'params' => $params
            ]);
        }
    }
}
