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
        Schema::create('testdriverequests', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('phone',10);
            $table->string('email',150);
            $table->string('car',100);
            $table->dateTime('dateTest');
            $table->foreignId('testDriveMethod_id')->constrained('testdrivemethod')->onDelete('cascade');
            $table->string('note',200);
            $table->string('status',30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testdriverequests');
    }
};
