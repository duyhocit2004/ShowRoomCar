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
        Schema::create('locationshowrooms', function (Blueprint $table) {
            $table->id();
            $table->string('City');
            $table->string('name',100);
            $table->string('table',30);
            $table->string('Opening hours');
            $table->string('phone',10);
            $table->string('ShowroomArea',100);
            $table->text('location');
            $table->boolean('has_test_drive')->default(false);
            $table->boolean('has_service')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->boolean('has_accessories')->default(false);
            $table->boolean('has_insurance')->default(false);
            $table->boolean('has_body_paint')->default(false);
            $table->string('status')->default('active');
            $table->string('locationOnGoogle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locationshowroom');
    }
};
