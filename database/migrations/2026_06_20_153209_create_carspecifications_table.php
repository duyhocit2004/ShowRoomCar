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
        Schema::create('carspecifications', function (Blueprint $table) {
            $table->id();
            $table->string('engine', 40)->nullable();
            $table->string('horsepower', 40)->nullable();
            $table->string('torque', 40)->nullable();
            $table->string('fuel_consumption', 40)->nullable();
            $table->string('acceleration', 40)->nullable();
            $table->string('top_speed', 40)->nullable();
            $table->string('safety_rating', 40)->nullable();
            $table->string('warranty_info', 40)->nullable();
            $table->string('transmission', 40)->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('wheelbase')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('fuel_tank_capacity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_specifications');
    }
};
