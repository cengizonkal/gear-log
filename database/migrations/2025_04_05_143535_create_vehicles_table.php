<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_model_id')
                ->constrained()
                ->onDelete('cascade');


            $table->string('license_plate')->unique();
            $table->unsignedInteger('mileage')->nullable();
            $table->foreignId('owner_id')
                ->constrained()
                ->onDelete('cascade');




            $table->foreignId('fuel_type_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('vin',20)->unique()->nullable();


            $table->unsignedInteger('year')->nullable();
            $table->unsignedInteger('engine_capacity')->nullable();
            $table->unsignedInteger('weight')->nullable();



            $table->timestamps();




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
