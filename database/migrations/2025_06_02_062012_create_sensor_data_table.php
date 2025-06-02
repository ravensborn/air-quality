<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable();
            $table->string('icon')->nullable();
            $table->string('name');
            $table->string('unit')->nullable();
            $table->string('endpoint_id');
            $table->string('value');
            $table->bigInteger('sequence_number');
            $table->dateTime('last_updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
