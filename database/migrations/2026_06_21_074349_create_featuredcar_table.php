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
        Schema::create('featuredcar', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('title',100);
            $table->string('iconDetail1');
            $table->string('titleDetail1');
            $table->string('iconDetail2');
            $table->string('titleDetail2');
            $table->string('iconDetail3');
            $table->string('titleDetail3');
            $table->integer('price');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featuredcar');
    }
};
