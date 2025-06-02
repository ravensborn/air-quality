<?php

use App\Console\Commands\UpdateSensors;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


Schedule::command('app:update-sensors')
    ->onOneServer()
    ->everyMinute();
