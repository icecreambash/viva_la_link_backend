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
        Schema::create('histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('user_id');
            $table->dateTime('time_search');
            $table->foreignUuid('airline_id')->nullable();
            $table->foreignUuid('from_city_id');
            $table->foreignUuid('to_city_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
