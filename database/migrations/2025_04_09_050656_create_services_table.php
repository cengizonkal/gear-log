<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 *@property mixed  $id
 *@property mixed  $vehicle_id
 *@property mixed  $user_id
 *@property mixed  $started_at
 *@property mixed  $finished_at
 *@property mixed  $created_at
 *@property mixed  $updated_at
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();


            $table->foreignId('vehicle_id')
                ->constrained()
                ->onDelete('cascade');


            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

           $table->foreignId('status_id');

            $table->text('description')->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
